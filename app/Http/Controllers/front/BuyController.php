<?php

namespace App\Http\Controllers\front;

use App\Helpers\CommonHelper;
use App\Helpers\MailEntryHelper;
use App\Http\Controllers\Controller;
use App\Mail\TestEmail;
use App\Models\CompanySettings;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\EmailTemplates;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\PaymentIntegration;
use App\Models\SendMail;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Razorpay\Api\Api;
use Kishanio\CCAvenue\Payment as CCAvenueClient;
use Mail;

class BuyController extends Controller
{
    const TEST_URL = 'https://sandboxsecure.payu.in';
    const PRODUCTION_URL = 'https://secure.payu.in';

    public function get_buy_form(Request $request)
    {
        $product_id         = $request->product_id;
        $product_info       = Product::find($product_id);
        $gateways           = PaymentIntegration::all();
        $country            = Country::all();
        $modal_title        = 'Buy Now';
        if( isset(session('client')->id) && !empty( session('client')->id ) ) {
            $customer_info  = Customer::find(session('client')->id);
        }
        
        $params = array(
            'product_info' => $product_info,
            'product_id' => $product_id,
            'modal_title' => $modal_title,
            'gateways' => $gateways,
            'country' => $country,
            'customer_info' => $customer_info ?? ''
        );
        return view('front.buy.buy_form', $params);
    }

    public function submit_buy_form(Request $request)
    {
        //pay_gateway
        $role_validator   = [
            'pay_gateway'      => ['required', 'string', 'max:255'],
        ];
        //Validate the product
        $validator                     = Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {
            $customer = Customer::where('email', $request->email)->first();
            $product_info = Product::find($request->product_id);
            $order_no = 'TXN' . date('mdyhis');
            $temp_no = base64_encode('TEMP' . date('mdyhis'));
            if( isset(session('client')->id) && !empty( session('client')->id ) ) {
                $customer_id = session('client')->id;
            } else {
                if (isset($customer) && !empty($customer)) {
                    $customer_id = $customer->id;
                    $customer_info = Customer::find($customer_id);
                    $customer_info->mobile_no = $request->mobile_no;
                    $customer_info->dial_code = $request->dial_code;
                    $customer_info->update();
                } else {
                    $randomString = rand(0, 999999);
                    $password = Hash::make($randomString);
                    $ins['status'] = 1;
                    $ins['first_name'] = $request->name;
                    $ins['email'] = $request->email;
                    $ins['password'] = $password;
                    $ins['mobile_no'] = $request->mobile_no;
                    $ins['dial_code'] = $request->dial_code;
                    $ins['added_by'] = 1;
                    $customer_id = Customer::create($ins)->id;
                    //send password in sms 
                    $params = array('password' => $randomString);
                    sendSMS($request->mobile_no, 'new_registration', $params);
                    MailEntryHelper::welcomeMessage($customer_id ?? null, $request->email);
                }
            }
            

            if ($request->pay_gateway == 'razorpay') {
                $payment_method = 'razor';
                $route = route('razorpay.request', ['order_no' => $order_no]);
            } else if ($request->pay_gateway == 'payumoney') {
                $payment_method = $request->pay_gateway;
                $route = route('redirectToPayU', ['order_no' => $order_no]);
            } else {
                $payment_method = $request->pay_gateway;
                $route = 'https://phoenixtech.app/ccavenue/pay.php';
            }

            $ord_ins['order_id'] = $order_no;
            $ord_ins['amount'] = $product_info->price;
            $ord_ins['customer_id'] = session('client')->id ?? $customer_id;
            $ord_ins['product_code'] = $product_info->product_code;
            $ord_ins['payment_gateway'] = $request->pay_gateway;
            $ord_ins['description'] = '';
            $ord_ins['status'] = 'pending';

            Order::create($ord_ins);

            $ins['payment_mode'] = 'online';
            $ins['customer_id'] = session('client')->id ?? $customer_id;
            $ins['amount'] = $product_info->price;
            $ins['payment_method'] = $payment_method;
            $ins['order_id'] = $order_no;
            $ins['payment_status'] = 'pending';
            $ins['temp_no'] = $temp_no;
            Payment::create($ins);
            $success = 'Payment Added';
            $pay_params = array(
                    'order_no' => $order_no, 
                    'name' => $request->name, 
                    'email' => $request->email,
                    'mobile_no' => $request->mobile_no,
                    'amount' => $product_info->price
                );
            return response()->json(['error' => [$success], 'pay_params' => $pay_params, 'status' => '0', 'order_no' => $order_no, 'payment_method' => $request->pay_gateway, 'route' => $route]);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }
    public function razorpay_initiate_request(Request $request)
    {
        $order_no = $request->order_no;
        $order_info = Order::where(['order_id' => $order_no, 'status' => 'pending'])->first();
        if (isset($order_info) && !empty($order_info)) {
            $payment_info = Payment::where('order_id', $order_no)->first();

            $pay_info = PaymentIntegration::where('gateway', 'Razorpay')->first();
            // Create an object of razorpay
            if ($pay_info->enabled == 'live') {
                $razorpay_id = $pay_info->live_access_key;
                $api = new Api($pay_info->live_access_key, $pay_info->live_secret_key);
            } else {
                $razorpay_id = $pay_info->test_access_key;

                $api = new Api($pay_info->test_access_key, $pay_info->test_secret_key);
            }
            // In razorpay you have to convert rupees into paise we multiply by 100
            // Currency will be INR
            // Creating order
            $order = $api->order->create(
                array(
                    'receipt' => now()->timestamp,
                    'amount' => $order_info->amount * 100,
                    'currency' => 'INR'
                )
            );

            if (isset($payment_info->invoice_id) && !empty($payment_info->invoice_id)) {
                $invoice_id = $payment_info->invoice_id;
            } else {
                //insert in invoice and invoice item table
                $invoice_no = CommonHelper::get_invoice_code();
                $ins['invoice_no'] = $invoice_no;
                $ins['order_no'] = $order_no;
                $ins['issue_date'] = date('Y-m-d');
                $ins['due_date'] = date('Y-m-d');
                $ins['customer_id'] = $order_info->customer_id;
                $ins['address'] = $order_info->customer->address;
                $ins['email'] = $order_info->customer->email;

                $ins['total'] = $order_info->amount;
                $ins['status'] = 0;

                $invoice_id = Invoice::create($ins)->id;
                $product_info = Product::where('product_code', $order_info->product_code)->first();
                $up_data = [];
                $ups['invoice_id'] = $invoice_id;
                $ups['product_id'] = $product_info->id ?? '';
                $ups['description'] = '';
                $ups['qty'] = 1;
                $ups['unit_price'] = $order_info->amount;
                $ups['discount'] = 0;
                $ups['cgst'] = 0;
                $ups['sgst'] = 0;
                $ups['igst'] = 0;
                $ups['amount'] = $order_info->amount;

                InvoiceItem::create($ups);
                $pdf_template = $request->pdf_template;
                $this->generatePDF($invoice_id, $pdf_template);
            }


            // Return response on payment page
            $response = [
                'orderId' => $order['id'],
                'razorpayId' => $razorpay_id,
                'amount' => $order_info->amount * 100,
                'name' => $order_info->customer->first_name,
                'currency' => 'INR',
                'email' => $order_info->customer->email,
                'contact_no' => $order_info->customer->mobile_no,
                'address' => $order_info->customer->address,
                'description' => 'description',
                'customer_id' => $order_info->customer_id,
                'invoice_id' => $invoice_id,
                'txn_no' => '',
                'order_no' => $order_no,
            ];

            $payment_info->currency = 'INR';
            $payment_info->invoice_id = $invoice_id;
            $payment_info->name = $order_info->customer->first_name;
            $payment_info->email = $order_info->customer->email;
            $payment_info->contact_no = $order_info->customer->mobile_no;
            $payment_info->description = 'Razor pay transaction';
            $payment_info->session_id = session()->getId();
            $payment_info->update();

            Session::put('pay_post', $response);
            // Let's checkout payment page is it working
            return view('front.buy.razor_pay_page', compact('response'));
        } else {
            abort(403);
        }
    }

    // In this function we return boolean if signature is correct
    private function SignatureVerify($_signature, $_paymentId, $_orderId)
    {
        try {
            // Create an object of razorpay class
            $pay_info = PaymentIntegration::where('gateway', 'Razorpay')->first();
            if ($pay_info->enabled == 'live') {
                $api = new Api($pay_info->live_access_key, $pay_info->live_secret_key);
            } else {
                $api = new Api($pay_info->test_access_key, $pay_info->test_secret_key);
            }
            $attributes  = array('razorpay_signature'  => $_signature,  'razorpay_payment_id'  => $_paymentId,  'razorpay_order_id' => $_orderId);
            $order  = $api->utility->verifyPaymentSignature($attributes);
            return true;
        } catch (\Exception $e) {
            // If Signature is not correct its give a excetption so we use try catch
            return false;
        }
    }

    public function razor_payment_complete(Request $request)
    {

        // Now verify the signature is correct . We create the private function for verify the signature
        $signatureStatus = $this->SignatureVerify(
            $request->all()['rzp_signature'],
            $request->all()['rzp_paymentid'],
            $request->all()['rzp_orderid']
        );

        $pay_post = $request->session()->pull('pay_post');
        // echo '<pre>';
        // print_r( $pay_post );
        $temp_no = base64_encode('TEMP' . date('mdyhis'));
        $pay_info = Payment::where('session_id', session()->getId())->first();
        $pay_info->payment_response = serialize($request->all());
        $pay_info->temp_no = $temp_no;
        $pay_info->update();
        // print_r( $pay_info );

        $pay_info->razorpay_id = $request->all()['rzp_orderid'];
        $pay_info->reference_no = $request->all()['rzp_paymentid'];
        // If Signature status is true We will save the payment response in our database
        // In this tutorial we send the response to Success page if payment successfully made
        if ($signatureStatus == true) {
            // dd( $pay_info );
            $pay_info->payment_status = 'paid';
            $pay_info->session_id = '';
            $pay_info->update();
            //update in invoice table
            $invoice = Invoice::find($pay_info->invoice_id);
            $invoice->paid_at = date('Y-m-d H:i:s');
            $invoice->paid_amount = $pay_info->amount;
            $invoice->approved_at = date('Y-m-d H:i:s');
            $invoice->status = 1;
            $invoice->update();

            $order_info = Order::where('order_id', $pay_info->order_id)->first();
            $order_info->status = 'completed';
            $order_info->update();
            $res_msg = ['erorr' => 'success', 'message' => 'Payment Success', 'order_no' => $pay_info->order_id, 'invoice_no' => $invoice->invoice_no];
            Session::put('razorpay_response', $res_msg);

            //send email 
            $company = CompanySettings::find(1);
            $product_name = '';
            if( isset($order_info->product->product_name) && !empty($order_info->product->product_name) ) {
                $product_name = $order_info->product->product_name;
            }

            $extract = array(
                'company_name' => $company->site_name,
                'product' => $order_info->order_id . ' ' . $product_name,
                'amount' => $order_info->amount,
                'confirmed_date' => date('d M Y'),
            );

            $ins_mail = array(
                'type' => 'order',
                'type_id' => $order_info->id,
                'email_type' => 'success_payment',
                'params' => serialize($extract),
                'to' => $order_info->customer->email ?? 'duraibytes@gmail.com',
                'send_type' => 'customer'
            );
            SendMail::create($ins_mail);
            if (isset($invoice->deal_id) && !empty($invoice->deal_id)) {
                CommonHelper::send_payment_received_notification($invoice->deal_id);
            }

            if( isset(session('client')->id) && !empty( session('client')->id ) ) {

                return redirect()->route('orders')->with('status', 'Profile updated!');

            } else {

                return redirect()->route('landing.index')->with('status', 'Profile updated!');

            }

            // You can create this page
        } else {
            $pay_info->payment_status = 'failed';
            $pay_info->update();
            $res_msg = ['erorr' => 'error', 'message' => 'Payment Failed', 'order_no' => $pay_info->order_id];
            Session::put('razorpay_response', $res_msg);
            $_SESSION['razor_response'] = $res_msg;

            if( isset(session('client')->id) && !empty( session('client')->id ) ) {

                return redirect()->route('orders')->with('status', 'Profile updated!');

            } else {
            
                return redirect()->route('landing.index')->with('status', 'Profile updated!');
            }

            // You can create this page
        }
        session()->forget('pay_post');
        if( isset(session('client')->id) && !empty( session('client')->id ) ) {

            return redirect()->route('orders')->with('status', 'Profile updated!');

        } else {
            return redirect()->route('landing.index');
        }
    }

    public function generatePDF($id, $pdf_template = '')
    {
        $info = Invoice::find($id);
        $company = CompanySettings::find(1);
        $taxable = DB::table('invoice_items')
            ->join('products', 'invoice_items.product_id', '=', 'products.id')
            ->select('products.hsn_no', 'invoice_items.qty', 'invoice_items.unit_price', DB::raw('(invoice_items.qty * invoice_items.unit_price) as price'), 'invoice_items.cgst', 'invoice_items.sgst', 'invoice_items.igst')
            ->where('invoice_items.invoice_id', $id)
            ->groupBy('products.hsn_no')
            ->get();
        $data = [
            'info' => $info,
            'company' => $company,
            'taxable' => $taxable,
        ];
        // return view('crm.invoice.templates.invoice_template_two', $data);

        if (!empty($pdf_template)) {
            $pdf = PDF::loadView('crm.invoice.templates.invoice_template_' . $pdf_template, $data);
            $path = public_path('invoice');
            return $pdf->save($path . '/' . str_replace("/", "_", $info->invoice_no) . '.pdf');
        } else {
            $pdf = PDF::loadView('mypdf', $data);
            $path = public_path('invoice');
            return $pdf->save($path . '/' . str_replace("/", "_", $info->invoice_no) . '.pdf');
        }
    }
}