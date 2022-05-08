<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\CompanySettings;
use App\Models\Customer;
use App\Models\Deal;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentIntegration;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use Session;

class PaymentController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Payments', 'btn_fn_param' => '', 'btn_href' => route('payments.add') );
        return view('crm.payments.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'created_at', 'order_id', 'page', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = Payment::count();
        // DB::enableQueryLog();
        if( $order != 'created_at') {
            $list               = Payment::skip($start)->take($limit)->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = Payment::skip($start)->take($limit)->Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Payment::count();
        } else {
            $total_filtered = Payment::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $payment ) {
               
                $nested_data[ 'date' ]              = date('d/M/Y h:i A', strtotime($payment->created_at) );
                $nested_data[ 'order_id' ]          = $payment->order_id;
                $nested_data[ 'customer' ]          = $payment->customer->first_name;
                $nested_data[ 'payment_mode' ]      = ucwords($payment->payment_mode);
                $nested_data[ 'amount' ]            = $payment->amount;
                $nested_data[ 'payment_method' ]    = ucwords($payment->payment_method);
                $nested_data[ 'status' ]            = ucwords($payment->payment_status);

                $action = '
                <a href="javascript:void(0);" class="action-icon" onclick="return view_modal(\'payments\', '.$payment->id.')"> <i class="mdi mdi-eye"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'payments\', '.$payment->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data['action']  = $action;

                $data[]                             = $nested_data;
            }
        }

        return response()->json( [ 
            'draw'              => intval( $request->input( 'draw' ) ),
            'recordsTotal'      => intval( $total_list ),
            'data'              => $data,
            'recordsFiltered'   => intval( $total_filtered )
        ] );

    }

    public function add(Request $request) {
        $params[ 'title' ]  = 'Add Payment';
        $request->session()->forget('pay_post');

        return view( 'crm.payments.add', $params );
    }

    public function autocomplete_customer(Request $request) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $query              = $request->org;
        $list               = Customer::search( $query )
                                ->get();
        $params['list']     = $list;
        $params['query']    = $query;

        return view('crm.common._autocomplete_pay_customer', $params);
    }

    public function customer_deal_info(Request $request) { 
        $customer_id = $request->customer_id;
        $invoice_info = Invoice::where('customer_id', $customer_id)->whereNotNull('approved_at')->whereNull('paid_at')->get();
        
        echo view('crm.payments._deal_select', ['info' => $invoice_info ]);
    }

    public function save(Request $request) {
        $payment_mode = $request->payment_mode;
        if( isset( $payment_mode ) && $payment_mode == 'online' ) {
            //pay_gateway
            $role_validator   = [
                'pay_gateway'      => [ 'required', 'string', 'max:255'],
            ];
        } else {
            $role_validator   = [
                'payment_mode'      => [ 'required', 'string', 'max:255'],
                'payment_method'      => [ 'required', 'string', 'max:255'],
                'amount'      => [ 'required', 'string', 'max:255'],
                'payment_status'      => [ 'required', 'string', 'max:255'],
            ];
        }
        
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {
            if( $request->payment_mode == 'online' ) {
                $success = 'Redirect to Payment page';
                $request->session()->put('pay_post', $_POST);

                return response()->json(['error'=>[$success], 'status' => '0', 'pay_gateway' => $request->pay_gateway]);
            } else {
                $ins['payment_mode'] = $request->payment_mode;
                $ins['customer_id'] = $request->customer_id;
                $ins['deal_id'] = $request->deal_id ?? null;
                $ins['invoice_id'] = $request->invoice_id ?? null;
                $ins['amount'] = $request->amount;
                $ins['payment_method'] = $request->payment_method;
                $ins['cheque_no'] = $request->cheque_no ?? null;
                if( $request->cheque_date) {
                    $ins['cheque_date'] = date('Y-m-d', strtotime($request->cheque_date ));
                }
                $ins['reference_no'] = $request->reference_no ?? null;
                $ins['order_id'] = 'TXN'.date('mdyhis');
                $ins['payment_status'] = $request->payment_status;
                $ins['added_by'] = Auth::id();
                
                Payment::create($ins);
                $success = 'Payment Added';
                
                return response()->json(['error'=>[$success], 'status' => '0']);
            }

           
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Payment::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }

    public function view(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Payment Info';
        $info = Payment::find($id);
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.payments.view', $params);
    }

    public function customer_deal_amount(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $invoice_id = $request->invoice_id;
        $deal_info = Invoice::find( $invoice_id );
        $amount = $deal_info->total;
        $params['amount'] = $amount;
        return response()->json($params);

    }

    public function get_page(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $mode = $request->mode;
        $request->session()->forget('pay_post');

        if( $mode == 'offline') {
            return view('crm.payments._offline');
        } else {
            $gateways = PaymentIntegration::all();
            return view('crm.payments._online', ['gateways' => $gateways]);
        }
        
    }

    public function initiate_request(Request $request) {
        $payment_gateway = $request->payment_gateway;
        $pay_post = $request->session()->pull('pay_post');

        $info = Invoice::find($pay_post['invoice_id']);
        $pay_post['info'] = $info;
        $pay_post['txn_no'] = 'TXN'.date('mdyhis');
        if( $payment_gateway == 'razorpay') {
            return view('crm.payments.razor.pay_form', $pay_post);
        } else {
            
        }
        
    }

    public function payment_initiate_request(Request $request) {
        // Generate random receipt id
        $receiptId = Str::random(20);
        $pay_info = PaymentIntegration::where('gateway', 'Razorpay')->first();
        // Create an object of razorpay
        $api = new Api($pay_info->test_access_key, $pay_info->test_secret_key);

        // In razorpay you have to convert rupees into paise we multiply by 100
        // Currency will be INR
        // Creating order
        $order = $api->order->create(array(
            'receipt' => $receiptId,
            'amount' => $request->all()['amount'] * 100,
            'currency' => 'INR'
            )
        );
        // Return response on payment page
        $response = [
            'orderId' => $order['id'],
            'razorpayId' => $pay_info->test_access_key,
            'amount' => $request->all()['amount'] * 100,
            'name' => $request->all()['name'],
            'currency' => 'INR',
            'email' => $request->all()['email'],
            'contact_no' => $request->all()['contact_no'],
            'address' => $request->all()['address'],
            'description' => 'Testing description',
            'customer_id' => $request->all()['customer_id'],
            'invoice_id' => $request->all()['invoice_id'],
            'txn_no' => $request->all()['txn_no'],
        ];
        //insert
        $ins['payment_mode'] = 'online';
        $ins['name'] = $request->all()['name'];
        $ins['currency'] = 'INR';
        $ins['email'] = $request->all()['email'];
        $ins['contact_no'] = $request->all()['contact_no'];
        $ins['address'] = $request->all()['address'];
        $ins['description'] = 'Testing description';
        $ins['customer_id'] = $request->all()['customer_id'];
        $ins['invoice_id'] = $request->all()['invoice_id'];
        $ins['session_id'] = session()->getId();
        $ins['payment_method'] = 'razor';
        $ins['amount'] = $request->all()['amount'];
        $ins['payment_status'] = 'pending';
        $ins['order_id'] = $request->all()['txn_no'];
        $ins['added_by'] = Auth::id();

        Payment::create($ins);
        // Session::put('pay_post', $response);
        // Let's checkout payment page is it working
        return view('crm.payments.razor.payment_page',compact('response'));
    }



    // In this function we return boolean if signature is correct
    private function SignatureVerify($_signature,$_paymentId,$_orderId)
    {
        try
        {
            // Create an object of razorpay class
            $pay_info = PaymentIntegration::where('gateway', 'Razorpay')->first();
            $api = new Api($pay_info->test_access_key, $pay_info->test_secret_key);
            $attributes  = array('razorpay_signature'  => $_signature,  'razorpay_payment_id'  => $_paymentId ,  'razorpay_order_id' => $_orderId);
            $order  = $api->utility->verifyPaymentSignature($attributes);
            return true;
        }
        catch(\Exception $e)
        {
            // If Signature is not correct its give a excetption so we use try catch
            return false;
        }
    }

    public function payment_complete(Request $request) {

        // Now verify the signature is correct . We create the private function for verify the signature
        $signatureStatus = $this->SignatureVerify(
            $request->all()['rzp_signature'],
            $request->all()['rzp_paymentid'],
            $request->all()['rzp_orderid']
        );

        $pay_post = $request->session()->pull('pay_post');

        $pay_info = Payment::where('session_id', session()->getId())->first();
        
        $pay_info->razorpay_id = $request->all()['rzp_orderid'];
        $pay_info->reference_no = $request->all()['rzp_paymentid'];
        // If Signature status is true We will save the payment response in our database
        // In this tutorial we send the response to Success page if payment successfully made
        if($signatureStatus == true)
        {
            $pay_info->payment_status = 'paid';
            $pay_info->session_id = '';
            $pay_info->update();
            //update in invoice table
            $invoice = Invoice::find($pay_info->invoice_id);
            $invoice->paid_at = date('Y-m-d H:i:s');
            $invoice->paid_amount = $pay_info->amount;
            $invoice->update();
            // You can create this page
            return view('crm.payments.razor._payment_success');
        }
        else{
            $pay_info->payment_status = 'failed';
            $pay_info->update();
            // You can create this page
            return view('crm.payments.razor._payment_fail');
        }

        return view('crm.payments.razor._payment_success');
    }
}
