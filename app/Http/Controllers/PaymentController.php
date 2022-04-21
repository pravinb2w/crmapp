<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\CompanySettings;
use App\Models\Customer;
use App\Models\Deal;
use App\Models\Payment;


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

        $columns            = [ 'id', 'page', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = Payment::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
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
        $deal_info = Deal::where('customer_id', $customer_id)->get();
        echo view('crm.payments._deal_select', ['info' => $deal_info ]);
    }

    public function save(Request $request) {
        
        $role_validator   = [
            'payment_mode'      => [ 'required', 'string', 'max:255'],
            'payment_method'      => [ 'required', 'string', 'max:255'],
            'amount'      => [ 'required', 'string', 'max:255'],
            'payment_status'      => [ 'required', 'string', 'max:255'],
        ];
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {

            $ins['payment_mode'] = $request->payment_mode;
            $ins['customer_id'] = $request->customer_id;
            $ins['deal_id'] = $request->deal_id ?? null;
            $ins['amount'] = $request->amount;
            $ins['payment_method'] = $request->payment_method;
            $ins['cheque_no'] = $request->cheque_no ?? null;
            if( $request->cheque_date) {
                $ins['cheque_date'] = date('Y-m-d', strtotime($request->cheque_date ));
            }
            $ins['reference_no'] = $request->reference_no ?? null;
            $ins['payment_status'] = $request->payment_status;
            $ins['added_by'] = Auth::id();
            
            Payment::create($ins);
            $success = 'Payment Added';
            
            return response()->json(['error'=>[$success], 'status' => '0']);
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
        $deal_id = $request->deal_id;
        $deal_info = Deal::find( $deal_id );
        $amount = $deal_info->deal_value;
        $params['amount'] = $amount;
        return response()->json($params);

    }
}
