<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySettings;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\LandingPages;
use CommonHelper;
use App\Models\EmailTemplates;
use App\Mail\TestEmail;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    public function index(Request $request, $permalink = null)
    {
        $info           = CompanySettings::find(1);
        $products       = Product::where('status', 1)->get();
        $params['info'] = $info;
        $response = $request->session()->pull('razorpay_response');
        $payment_error = $response['erorr'] ?? '';
        $payment_order_no = $response['order_no'] ?? '';
        $payment_message = $response['message'] ?? '';
        $payment_invoice_no = $response['invoice_no'] ?? '';
        // session()->forget('razorpay_response');
        if ($permalink  != null) {
            $result     = LandingPages::where('permalink', '=', $permalink)->first();
            if (empty($result)) {
                abort(404);
            }
        } else {
            $result = LandingPages::where('is_default_landing_page', 1)->first();
        }
        if (!$result) {
            $result   = LandingPages::latest()->first();
        }
        $params['result'] = $result;
        $params['products'] = $products;
        $params['payment_error'] = $payment_error;
        $params['payment_order_no'] = $payment_order_no;
        $params['payment_invoice_no'] = $payment_invoice_no;
        $params['payment_message'] = $payment_message;
        // dd($params);
        return view('landing.landing', $params);
    }

    public function enquiry_save(Request $request)
    {
        $id = $request->id;

        $role_validator = [
            'fullname'  => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255'],
            'mobile_no' => ['required', 'string', 'digits:10'],
            'subject'   => ['required', 'string', 'max:255'],
            'message'   => ['required', 'string', 'max:255'],
        ];
        //Validate the product
        $validator      =   Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {
            $customer = Customer::where('email', $request->email)->first();

            if (isset($customer) && !empty($customer)) {
                $customer_id = $customer->id;
            } else {
                $randomString = rand(0, 999999);
                $password = Hash::make($randomString);
                $ins['status'] = 1;
                $ins['first_name'] = $request->fullname;
                $ins['email'] = $request->email;
                $ins['password'] = $password;
                $ins['mobile_no'] = $request->mobile_no;
                $ins['added_by'] = 1;
                $customer_id = Customer::create($ins)->id;
                //send password in sms 
                $params = array('password' => $randomString);
                sendSMS($request->mobile_no, 'new_registration', $params);
            }
            //get assigned user id 
            $assigned_to = CommonHelper::getLeadAssigner();
            $lea['assigned_to'] = $assigned_to;

            $lea['customer_id'] = $customer_id;
            $lea['status'] = 1;
            $lea['added_by'] = 1;
            $lea['lead_subject'] = $request->subject;
            $lea['lead_description'] = $request->message;
            $lead_id = Lead::create($lea)->id;
            //insert in notification
            CommonHelper::send_lead_notification($lead_id, $assigned_to);

            //send email to new customer
            if (isset($customer) && !empty($customer)) {
            } else {
                $data   = EmailTemplates::where('email_type', 'new_registration')->first();
                CommonHelper::setMailConfig();
                $company = CompanySettings::find(1);
                $extract = array(
                    'name' => $request->fullname,
                    'app_name' => env('APP_NAME'),
                    'unsbusribe_link' => 'Unsubscribe',
                    'company_address' => $company->address ?? '',
                    'password' => $randomString,
                );
                $templateMessage = $data->content;
                $templateMessage = str_replace("{", "", addslashes($templateMessage));
                $templateMessage = str_replace("}", "", $templateMessage);
                extract($extract);
                eval("\$templateMessage = \"$templateMessage\";");

                $body = [
                    'content' => $templateMessage
                ];

                $send_mail = new TestEmail($body, $data->title ?? '');
                // return $send_mail->render();
                Mail::to($request->email ?? 'duraibytes@gmail.com')->send($send_mail);
                // end send mail conversion
            }

            $success = 'Enquiry has been sent';
            return response()->json(['error' => [$success], 'status' => '0']);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }
}