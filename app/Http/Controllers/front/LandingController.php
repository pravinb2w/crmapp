<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Helpers\MailEntryHelper;
use Illuminate\Http\Request;
use App\Models\CompanySettings;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\LandingPages;
use App\Models\Announcement;
use CommonHelper;
use App\Models\EmailTemplates;
use App\Mail\TestEmail;
use App\Models\Country;
use App\Models\Newsletter;
use App\Models\Product;
use App\Models\SendMail;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator;
use Auth;

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
        $not_home = 'home';
        $params['not_home'] = $not_home;
        $params['result'] = $result;
        $params['products'] = $products;
        $params['payment_error'] = $payment_error;
        $params['payment_order_no'] = $payment_order_no;
        $params['payment_invoice_no'] = $payment_invoice_no;
        $params['payment_message'] = $payment_message;
        $params['announcements'] = Announcement::all();
        $params['country'] = Country::all();
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
                $ins['dial_code'] = $request->dial_code;
                $ins['added_by'] = 1;
                $customer_id = Customer::create($ins)->id;
                //send password in sms 
                $params = array('password' => $randomString);
                sendSMS($request->mobile_no, 'new_registration', $params);
                sendWhatsappApi($request->mobile_no, 'new_registration', $params, 'sms');
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
                MailEntryHelper::welcomeMessage($lead_id, $request->email);
                MailEntryHelper::leadAddition($lead_id, $request->email);
            }

            $success = 'Enquiry has been sent';
            return response()->json(['error' => [$success], 'status' => '0']);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }

    public function subscribeNewsletter(Request $request)
    {

        $role_validator = [
            'subscribe_email'     => ['required', 'string', 'email', 'unique:newsletters,email', 'max:255'],
        ];
        //Validate the product
        $validator      =   Validator::make($request->all(), $role_validator,['subscribe_email.unique' => 'Email id has been already subscribed for newsletter']);

        if ($validator->passes()) {
            $ins['email'] = $request->subscribe_email;
            $news_id = Newsletter::create($ins)->id;

            $company = CompanySettings::find(1);
            $title = 'Newsletter Subscription Activation';
            $message = 'Thanks for subscribing Newsletter.';
            $extract = array(
                'rm_name' => $request->subscribe_email,
                'message' => $message,
                'additional_information' => '',
                'company_name' => $company->site_name,
                'subject' => $title,

            );

            $ins_mail = array(
                'type' => 'Newsletter',
                'type_id' => $news_id,
                'email_type' => 'general_task',
                'params' => serialize($extract),
                'to' => $request->subscribe_email ?? 'duraibytes@gmail.com'
            );
            DB::table('send_mail')->insert($ins_mail);

            $success = 'Newsletter subscribed successfully';
            return response()->json(['error' => [$success], 'status' => '0']);

        } else {
            return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);

        }
    }
}