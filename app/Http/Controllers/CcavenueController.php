<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Models\CompanySettings;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use PDF;

class CcavenueController extends Controller
{
    public function success_payment(Request $request)
    {
        echo '<pre>';
        print_r( $_POST );
        $order_id = $_POST['order_id'];
        if( isset( $order_id ) && !empty( $order_id ) ) {
            $order_info = Order::where('order_id', $order_id)->first();
            $payment_info = Payment::where('order_id', $order_id)->first();

            if (isset($payment_info->invoice_id) && !empty($payment_info->invoice_id)) {
                $invoice_id = $payment_info->invoice_id;
            } else {
                //insert in invoice and invoice item table
                $invoice_no = CommonHelper::get_invoice_code();
                $ins['invoice_no'] = $invoice_no;
                $ins['order_no'] = $order_id;
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

                $payment_info->invoice_id = $invoice_id;
            }
            $payment_info->name = $_POST['billing_name'];
            $payment_info->email = $_POST['billing_email'];
            $payment_info->contact_no = $_POST['billing_tel'];
            $payment_info->payment_response = serialize($_POST);
            if( strtolower($_POST['order_status']) == 'success' ) {
                $payment_status = 'paid';
            } else {
                $payment_status = 'failed';
            }
            $payment_info->payment_status = $payment_status;
            $payment_info->update();

            $invoice = Invoice::find($invoice_id);
            $invoice->paid_at = date('Y-m-d H:i:s');
            $invoice->paid_amount = $_POST['amount'];
            $invoice->approved_at = date('Y-m-d H:i:s');
            $invoice->status = 1;
            $invoice->update();

            $order_info = Order::where('order_id', $order_id)->first();
            $order_info->status = 'completed';
            $order_info->update();

            if( $payment_status == 'paid' ) {
                $res_msg = ['erorr' => 'success', 'message' => 'Payment Success', 'order_no' => $order_id, 'invoice_no' => $invoice->invoice_no];
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
                    'to' => $order_info->customer->email ?? 'duraibytes@gmail.com'
                );
                SendMail::create($ins_mail);
                if (isset($invoice->deal_id) && !empty($invoice->deal_id)) {
                    CommonHelper::send_payment_received_notification($invoice->deal_id);
                }

                return redirect()->route('landing.index')->with('status', 'Payment completed!');

            } else {
                $res_msg = ['erorr' => 'error', 'message' => 'Payment Failed', 'order_no' => $order_id];
                Session::put('razorpay_response', $res_msg);
                $_SESSION['razor_response'] = $res_msg;
            }
            
            return redirect()->route('landing.index')->with('status', 'Payment completed!');
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

    public function cancel_payment(Request $request)
    {
        dd($request);
    }

    public function response_handler(Request $request)
    {

        $merchant_data = '';
        $working_key = '81E0204433275CCA7E007B7781545845';
        $access_code = 'AVOQ87JF30BA32QOAB';
        $merchant_id = '976366';
        $orderId = 'ORDTEXT90900';
        foreach ($_POST as $key => $value) {
            $merchant_data .= $key . '=' . $value . '&';
        }
        $merchant_data .= 'order_id=' . $orderId;

        $encrypted_data = encrypt_crypto($merchant_data, $working_key);

        return view('ccavenue-handler-form', compact('encrypted_data', 'access_code'));
    }
}