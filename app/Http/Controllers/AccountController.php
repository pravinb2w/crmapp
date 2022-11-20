<?php

namespace App\Http\Controllers;

use App\Models\ApiData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Models\User;
use App\Models\CompanySettings;
use App\Models\PrefixSetting;
use App\Models\SmsIntegration;
use App\Models\PaymentIntegration;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // dd( env('DB_DATABASE') );
        // $fileSize = getDatabaseSize();
        // dd( $fileSize );
        // $file_size = 0;
        // $filepath   = storage_path('app/public');
        // foreach( File::allFiles($filepath) as $file)
        // {
        //     dump( $file );
        //     $file_size += $file->getSize();
        // }
        // $mb_size = number_format($file_size / 1048576,2);
        // dd( $mb_size );

        
        $type = $request->segment(3);
        $url = 'change';
        if (empty($type)) {
            $url = 'profile';
        }
        $params['type'] = $url;
        return view('crm.account.account_index', $params);
    }

    public function get_settings_tab(Request $request)
    {
        $type = $request->type;
        $id = Auth::id();
        $info = User::find($id);
        $prefix = PrefixSetting::where(['company_id' => $info->company_id, 'status' => 1])->get();
        $sms = SmsIntegration::where('company_id', $info->company_id)->get();
        $gateway = PaymentIntegration::all();

        $payFromMethod = planSettings('payment_gateway');
        $dynamic_gateways = [];
        if( isset( $payFromMethod ) && !empty( $payFromMethod ) ) {
            $payFrom = explode( ',', $payFromMethod );
            if( !empty( $payFrom ) ) {
                foreach ($payFrom as $item) {
                    if( $item == 'payu') {
                        $field = 'payumoney';
                        $value = 'PayUmoney';
                    } else if($item == 'ccavenue') {
                        $field = 'ccavenue';
                        $value = 'CCAvenue';
                    } else if($item == 'razorpay') {
                        $field = 'razorpay';
                        $value = 'Razor Pay';
                    }
                    $dynamic_gateways[$field] = $value;
                }
            }
        } 
        $params = ['type' => $type, 'info' => $info, 'prefix' => $prefix, 'sms' => $sms, 'gateway' => $gateway, 'dynamic_gateways' => $dynamic_gateways];
        $view = 'crm.account._account_' . $type;
        return view($view, $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        $type = $request->type;

        if ($type == 'profile') {
            $validator   = [
                'first_name'      => ['required', 'string', 'max:255'],
                'email'      => ['required', 'string', 'max:255'],
                'mobile_no'      => ['required', 'string', 'unique:users,mobile_no,' . Auth::id()],
                'profile_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg']
            ];
        }
        //Validate the product
        $validator                     = Validator::make($request->all(), $validator);

        if ($validator->passes()) {
            $id = Auth::id();
            $user = User::find($id);
            $user->name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->mobile_no = $request->mobile_no;
            $user->primary_color = $request->primary_color;
            $user->secondary_color = $request->secondary_color;
            if ($request->hasFile('profile_image')) {
                $file                       = $request->file('profile_image')->store('account', 'public');
                $user->image                  = $file;
            }
            $user->save();
            $success = 'Account settings saved';
            return response()->json(['error' => [$success], 'status' => '0']);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }

    public function company_save(Request $request)
    {

        $type = $request->type;
        if (isset($type) && ($type != 'api' && $type != 'sms' && $type != 'link' && $type != 'prefix' && $type != 'common')) {
            if ($type == 'company') {
                $validator   = [
                    'site_name' => ['required', 'string', 'max:255'],
                    'site_logo' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
                    'site_favicon' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
                ];
            } else if ($type == 'mail') {
                $validator   = [
                    'smtp_host' => ['required', 'string', 'max:255'],
                    'smtp_port' => ['required', 'max:5'],
                    'smtp_user' => ['required', 'string', 'max:55'],
                    'smtp_password' => ['required', 'string', 'max:55'],
                ];
            } else {
                $validator   = [
                    'current_password' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'confirmed', 'min:8'],
                    'password_confirmation' => ['required', 'min:8'],
                ];
            }

            //Validate the product
            $validator                     = Validator::make($request->all(), $validator);

            if ($validator->passes()) {
                $id = Auth::id();

                $user = User::find($id);
                $sett = CompanySettings::find($user->company_id);
                if ($type == 'company') {
                    $sett->site_name = $request->site_name;
                    $sett->site_url = $request->site_url;
                    $sett->copyrights = $request->copyrights;
                    $sett->site_email = $request->site_email;
                    $sett->site_phone = $request->site_phone;
                    $sett->office_time = $request->office_time;
                    $sett->address = $request->address;
                    $sett->mentorship_link = $request->mentorship_link;
                    $sett->telegram_bot = $request->telegram_bot;
                    $sett->testimonial_link = $request->testimonial_link;
                    $sett->youtube_learning_link = $request->youtube_learning_link;
                    $sett->telegram_link = $request->telegram_link;
                    $sett->gstin_no = $request->gstin_no;
                    

                    if ($request->hasFile('site_logo')) {
                        $file                       = $request->file('site_logo')->store('account', 'public');
                        $sett->site_logo            = $file;
                    }
                    if ($request->hasFile('site_favicon')) {
                        $file                       = $request->file('site_favicon')->store('account', 'public');
                        $sett->site_favicon         = $file;
                    }
                    $sett->update();
                    $success = 'Account settings saved';
                    return response()->json(['error' => [$success], 'status' => '0']);
                } else if ($type == 'mail') {
                    $sett->smtp_host = $request->smtp_host;
                    $sett->smtp_port = $request->smtp_port;
                    $sett->smtp_user = $request->smtp_user;
                    $sett->smtp_password = $request->smtp_password;
                    $sett->mailer = $request->mailer;
                    $sett->mail_encryption = $request->mail_encryption;
                    $sett->update();
                    $success = 'Account settings saved';
                    return response()->json(['error' => [$success], 'status' => '0']);
                } else {
                    if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
                        // The passwords matches
                        $success = 'Current password does not match with this password';
                        return response()->json(['error' => [$success], 'status' => '1']);
                    }
                    $user->password = Hash::make($request->password);
                    $user->save();
                    $success = 'Password changed successfully';
                    return response()->json(['error' => [$success], 'status' => '0']);
                }
            }
            return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
        } else {
            $id = Auth::id();
            $user = User::find($id);
            $sett = CompanySettings::find($user->company_id);

            if ($type == 'sms') {

                $sms = SmsIntegration::where('company_id', $user->company_id)->first();
                $sms_type = $request->sms_type;
                $user_name = $request->user_name;
                $api_key = $request->api_key;
                $sender_id = $request->sender_id;
                $template_id = $request->template_id;
                $template_type = $request->template_type;
                $variables = $request->variables;
                $template = $request->template;
                $tmp = [];
                for ($i = 0; $i < count($sms_type); $i++) {
                    $tmp[] = [
                        'sms_type' => $sms_type[$i] ?? '',
                        'user_name' => $user_name[$i] ?? '',
                        'api_key' => $api_key[$i] ?? '',
                        'sender_id' => $sender_id[$i] ?? '',
                        'template_id' => $template_id[$i] ?? '',
                        'type' => $template_type[$i] ?? '',
                        'template' => $template[$i] ?? '',
                        'variables' => $variables[$i] ?? '',
                    ];
                }
                $all = SmsIntegration::truncate();
                if (!empty($tmp)) {
                    foreach ($tmp as $key => $value) {

                        $ins['sms_type'] = $value['sms_type'];
                        $ins['user_name'] = $value['user_name'];
                        $ins['api_key'] = $value['api_key'];
                        $ins['sender_id'] = $value['sender_id'];
                        $ins['template_id'] = $value['template_id'];
                        $ins['type'] = $value['type'];
                        $ins['template'] = $value['template'];
                        $ins['variables'] = $value['variables'];
                        $ins['company_id'] = $user->company_id;
                        SmsIntegration::create($ins);
                    }
                }
            } else if ($type == 'link') {
                $sett->facebook_url = $request->facebook_url;
                $sett->twitter_url = $request->twitter_url;
                $sett->instagram_url = $request->instagram_url;
                $sett->instagram_chat_link = $request->instagram_chat_link;
                $sett->whatsapp_chat_link = $request->whatsapp_chat_link;
                $sett->update();
            } else if ($type == 'common') {
                $sett->invoice_terms = $request->invoice_terms;
                $sett->lead_access = $request->lead_access ?? null;
                $sett->deal_access = $request->deal_access ?? null;
                $sett->workflow_automation = ($request->workflow_automation ? '1' : null);
                $sett->show_products = ($request->show_products ? '1' : null);
                // dd( $sett );
                $sett->update();
            } else if ($type == 'prefix') {

                $prefix_field = $request->prefix_field;
                $prefix_value = $request->prefix_value;
                $prefix_id = $request->prefix_id;
                $tmp = [];
                for ($i = 0; $i < count($prefix_field); $i++) {
                    $tmp[] = ['id' => $prefix_id[$i] ?? '', 'prefix_field' => $prefix_field[$i], 'prefix_value' => $prefix_value[$i]];
                }
                $all = PrefixSetting::truncate();
                if (!empty($tmp)) {
                    foreach ($tmp as $key => $value) {
                        // if( isset( $value['id'] ) && !empty($value['id']) ){
                        //     $pref = PrefixSetting::find($value['id']);
                        //     $pref->prefix_field = $value['prefix_field'];
                        //     $pref->prefix_value = $value['prefix_value'];
                        //     $pref->update();
                        // } else {
                        $ins['prefix_field'] = $value['prefix_field'];
                        $ins['prefix_value'] = $value['prefix_value'];
                        $ins['status'] = 1;
                        $ins['company_id'] = $user->company_id;
                        PrefixSetting::create($ins);
                        // }
                    }
                }
            } else if( $type == 'api' ) {
               
                $ins = $request->all();
                unset( $ins['api_type']);
                unset( $ins['type']);
                $ins_array = [];
                if( isset( $ins ) && !empty( $ins ) ){
                    foreach ($ins as $key => $value) {
                        $new_array = [];
                        $new_array['type'] = $request->api_type;
                        $new_array['field'] = $key;
                        $new_array['field_value'] = $value;
                        $ins_array[] = $new_array;
                        
                        $api_info = ApiData::where( ['type' => $request->api_type, 'field' => $key] )->first();
                        if( isset( $api_info ) && !empty( $api_info ) ) {
                            $api_info->field_value = $value;
                            $api_info->update();
                        } else {
                            ApiData::create($new_array);
                        }

                    }

                }
                
                
            }
            $success = 'Account settings saved';
            return response()->json(['error' => [$success], 'status' => '0']);
        }
    }

    public function payment_save(Request $request)
    {

        $payment_gateway        = $request->payment_gateway;
        $status                 = $request->status;
        $test_access_key        = $request->test_access_key;
        $test_secret_key        = $request->test_secret_key;
        $test_merchant_id       = $request->test_merchant_id;
        $live_merchant_id       = $request->live_merchant_id;
        $live_access_key        = $request->live_access_key;
        $live_secret_key        = $request->live_secret_key;
        $id                     = $request->id;
        
        $tmp = [];

        $user_id = Auth::id();
        $user = User::find($user_id);

        for ($i = 0; $i < count($payment_gateway); $i++) {
            $tmp[] = [
                'id' => $id[$i] ?? '', 
                'payment_gateway' => $payment_gateway[$i] ?? '', 
                'test_merchant_id' => $test_merchant_id[$i],
                'test_access_key' => $test_access_key[$i],
                'test_secret_key' => $test_secret_key[$i], 
                'live_merchant_id' => $live_merchant_id[$i],
                'live_access_key' => $live_access_key[$i],
                'live_secret_key' => $live_secret_key[$i], 
                'enabled' => ((isset($status[$i]) && !empty($status[$i]) ) ? 'live' : 'test')
            ];
        }
        $in_id = [];
        if (!empty($tmp)) {
            foreach ($tmp as $key => $value) {
                if (isset($value['payment_gateway']) && !empty($value['payment_gateway'])) {

                    if (isset($value['id']) && !empty($value['id'])) {
                        $in_id[] = $value['id'];
                        $pref = PaymentIntegration::find($value['id']);
                        $pref->gateway = $value['payment_gateway'];
                        $pref->test_merchant_id = $value['test_merchant_id'];
                        $pref->test_access_key = $value['test_access_key'];
                        $pref->test_secret_key = $value['test_secret_key'];
                        $pref->live_merchant_id = $value['live_merchant_id'];
                        $pref->live_access_key = $value['live_access_key'];
                        $pref->live_secret_key = $value['live_secret_key'];
                        $pref->enabled = $value['enabled'];
                        $pref->update();
                    } else {

                        $ins['gateway'] = $value['payment_gateway'];
                        $ins['test_access_key'] = $value['test_access_key'];
                        $ins['test_secret_key'] = $value['test_secret_key'];
                        $ins['test_merchant_id'] = $value['test_merchant_id'];
                        $ins['live_merchant_id'] = $value['live_merchant_id'];
                        $ins['live_access_key'] = $value['live_access_key'];
                        $ins['live_secret_key'] = $value['live_secret_key'];
                        $ins['enabled'] = $value['enabled'];
                        $ins['status'] = 1;
                        $ins['company_id'] = $user->company_id;
                      
                        $integrateId = PaymentIntegration::create($ins)->id;
                        $in_id[] = $integrateId;
                        // print_r( $integrateId );
                    }
                }
            }
        }
        
        if (!empty($in_id)) {
            $not_in = PaymentIntegration::whereNotIn('id', $in_id)->delete();
        }
        $success = 'Account settings saved';
        return response()->json(['error' => [$success], 'status' => '0']);
    }
}