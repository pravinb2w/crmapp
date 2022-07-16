<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\CompanySettings;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentIntegration;
use App\Models\SendMail;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


/**
 * Class PayuMoneyController
 */
class PayuMoneyController extends \InfyOm\Payu\PayuMoneyController
{
    const TEST_URL = 'https://sandboxsecure.payu.in';
    const PRODUCTION_URL = 'https://secure.payu.in';

    public function paymentCancel(Request $request)
    {
        $data = $request->all();
        if (!isset($data['txnid'])) {
            abort(404);
        }
        $order_no = $data['txnid'];

        $error_Message = $data['error_Message'];
        $status = $data['status'];

        $order_info = Order::where('order_id', $order_no)->first();
        $order_info->status = 'cancelled';
        $order_info->description = $error_Message;
        $order_info->added_by = Auth::id() ?? null;

        $order_info->update();

        $invoice = Invoice::where('order_no', $order_no)->first();
        $invoice->status = 2; //cancelled;
        $invoice->update();

        $payment_info = Payment::where('order_id', $order_no)->first();
        $payment_info->invoice_id = $invoice->id;
        $payment_info->name = $order_info->customer->first_name;
        $payment_info->contact_no = $order_info->customer->mobile_no;
        $payment_info->currency = 'INR';
        $payment_info->payment_response = serialize($data);
        $payment_info->status = 2;
        $payment_info->payment_status = 'failed';
        $payment_info->description = $error_Message;
        $payment_info->reference_no = $data['payuMoneyId'] ?? '';
        $payment_info->added_by = Auth::id() ?? null;

        $payment_info->update();

        //send email 
        $company = CompanySettings::find(1);
        $extract = array(
            'name' => $order_info->customer->first_name,
            'order_no' => $order_no,
            'app_name' => env('APP_NAME'),
            'company_name' => $company->site_name ?? '',
            'date' => date('d M Y h:i A', strtotime($order_info->created_at)),
            'invoice_no' => $invoice->invoice_no ?? ''
        );

        $ins_mail = array(
            'type' => 'order',
            'type_id' => $order_info->id,
            'email_type' => 'cancel_payment',
            'params' => serialize($extract),
            'to' => $order_info->customer->email,
        );

        SendMail::create($ins_mail);

        $res_msg = ['erorr' => 'error', 'message' => $error_Message, 'order_no' => $order_no];
        Session::put('razorpay_response', $res_msg);

        return redirect()->route('landing.index')->with('status', 'Payment Failed!');
    }

    public function paymentSuccess(Request $request)
    {

        $input = $request->all();

        $status = $input["status"];
        $firstname = $input["firstname"];
        $amount = $input["amount"];
        $txnid = $input["txnid"];
        $posted_hash = $input["hash"];
        $key = $input["key"];
        $productinfo = $input["productinfo"];
        $email = $input["email"];
        $salt = config('payu.salt_key');

        $data = $request->all();
        $order_no = $data['txnid'];
        $error_Message = $data['error_Message'];
        $status = $data['status'];

        $order_info = Order::where('order_id', $order_no)->first();
        $order_info->status = 'completed';
        $order_info->description = $error_Message;
        $order_info->added_by = Auth::id() ?? null;
        $order_info->update();

        $invoice = Invoice::where('order_no', $order_no)->first();
        $invoice->status = 1; //completed;
        $invoice->paid_at = date('Y-m-d H:i:s');
        $invoice->paid_amount = $amount;
        $invoice->added_by = Auth::id() ?? null;
        $invoice->update();

        $payment_info = Payment::where('order_id', $order_no)->first();
        $payment_info->invoice_id = $invoice->id;
        $payment_info->name = $order_info->customer->first_name;
        $payment_info->contact_no = $order_info->customer->mobile_no;
        $payment_info->currency = 'INR';
        $payment_info->payment_response = serialize($data);
        $payment_info->status = 1;
        $payment_info->payment_status = 'paid';
        $payment_info->description = $error_Message;
        $payment_info->reference_no = $data['payuMoneyId'] ?? '';
        $payment_info->added_by = Auth::id() ?? null;

        $payment_info->update();

        //send email 
        $company = CompanySettings::find(1);
        $extract = array(
            'company_name' => $company->site_name,
            'product' => $order_info->order_id . ' ' . $order_info->product->product_name ?? '',
            'amount' => $order_info->amount,
            'confirmed_date' => date('d M Y'),
        );

        $ins_mail = array(
            'type' => 'order',
            'type_id' => $order_info->id,
            'email_type' => 'success_payment',
            'params' => serialize($extract),
            'to' => $order_info->customer->email ?? 'duraibytes@gmail.com'
        );
        SendMail::create($ins_mail);

        $res_msg = ['erorr' => 'success', 'message' => $error_Message, 'order_no' => $order_no, 'invoice_no' => $invoice->invoice_no];
        Session::put('razorpay_response', $res_msg);

        return redirect()->route('landing.index')->with('status', 'Payment Failed!');
    }

    public function checkHasValidHas($data)
    {
        $status = $data["status"];
        $firstname = $data["firstname"];
        $amount = $data["amount"];
        $txnid = $data["txnid"];
        $errorMessage = $data["error_Message"];

        $posted_hash = $data["hash"];
        $key = $data["key"];
        $productinfo = $data["productinfo"];
        $email = $data["email"];
        $salt = "";

        // Salt should be same Post Request

        if (isset($data["additionalCharges"])) {
            $additionalCharges = $data["additionalCharges"];
            $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        } else {
            $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }

        $hash = hash("sha512", $retHashSeq);

        if ($hash != $posted_hash) {
            return  false;
        }

        return true;
    }

    public function redirectToPayU(Request $request)
    {
        $order_no = $request->order_no;
        $order_info = Order::where(['order_id' => $order_no, 'status' => 'pending'])->first();
        if (isset($order_info) && !empty($order_info)) {
            $payment_info = Payment::where('order_id', $order_no)->first();

            $pay_info = PaymentIntegration::where('gateway', 'payumoney')->first();

            //insert in invoice and invoice item table
            if (isset($payment_info->invoice_id) && !empty($payment_info->invoice_id)) {
                $invoice_id = $payment_info->invoice_id;
            } else {
                $invoice_no = CommonHelper::get_invoice_code();
                $ins['invoice_no'] = $invoice_no;
                $ins['order_no'] = $order_no;
                $ins['issue_date'] = date('Y-m-d');
                $ins['due_date'] = date('Y-m-d');
                $ins['customer_id'] = $order_info->customer_id;
                $ins['address'] = $order_info->customer->address;
                $ins['email'] = $order_info->customer->email;
                $ins['total'] = $order_info->product->price;
                $ins['status'] = 0;

                $invoice_id = Invoice::create($ins)->id;
                $up_data = [];
                $ups['invoice_id'] = $invoice_id;
                $ups['product_id'] = $order_info->product->id ?? '';
                $ups['description'] = '';
                $ups['qty'] = 1;
                $ups['unit_price'] = $order_info->product->price;
                $ups['discount'] = 0;
                $ups['cgst'] = 0;
                $ups['sgst'] = 0;
                $ups['igst'] = 0;
                $ups['amount'] = $order_info->product->price;
                InvoiceItem::create($ups);

                $pdf_template = $request->pdf_template;
                $this->generatePDF($invoice_id, $pdf_template);
            }


            $data = $request->all();

            // $MERCHANT_KEY = 'pkTb5Q';
            // $SALT = 'rnLkR8gkbg0x6QKpzSFBJm21kCZ2IqQ2';
            if ($pay_info->enabled == 'live') {
                $MERCHANT_KEY = $pay_info->live_access_key;
                $SALT = $pay_info->live_secret_key;
            } else {
                $MERCHANT_KEY = $pay_info->test_access_key;
                $SALT = $pay_info->test_secret_key;
            }

            // $PAYU_BASE_URL = config('payu.test_mode') ? self::TEST_URL : self::PRODUCTION_URL;
            $PAYU_BASE_URL = self::PRODUCTION_URL;
            $action = '';

            $posted = array();
            if (!empty($data)) {
                foreach ($data as $key => $value) {
                    $posted[$key] = $value;
                }
            }
            $formError = 0;

            if (empty($posted['txnid'])) {
                // Generate random transaction id
                $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
            } else {
                $txnid = $posted['txnid'];
            }

            $hash = '';
            // Hash Sequence
            $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
            if (empty($posted['hash']) && sizeof($posted) > 0) {
                if (
                    empty($posted['key'])
                    || empty($posted['txnid'])
                    || empty($posted['amount'])
                    || empty($posted['firstname'])
                    || empty($posted['email'])
                    || empty($posted['phone'])
                    || empty($posted['productinfo'])
                    || empty($posted['surl'])
                    || empty($posted['furl'])
                    || empty($posted['service_provider'])
                ) {
                    $formError = 1;
                } else {
                    //                $posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
                    $hashVarsSeq = explode('|', $hashSequence);
                    $hash_string = '';
                    foreach ($hashVarsSeq as $hash_var) {
                        $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                        $hash_string .= '|';
                    }

                    $hash_string .= $SALT;


                    $hash = strtolower(hash('sha512', $hash_string));
                    $action = $PAYU_BASE_URL . '/_payment';
                }
            } elseif (!empty($posted['hash'])) {
                $hash = $posted['hash'];
                $action = $PAYU_BASE_URL . '/_payment';
            }
            return view(
                'payumoney.pay',
                compact('hash', 'action', 'MERCHANT_KEY', 'formError', 'txnid', 'posted', 'SALT', 'order_info')
            );
        } else {
            abort(403);
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