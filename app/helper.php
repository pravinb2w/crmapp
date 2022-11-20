<?php

use App\Models\ApiData;
use Illuminate\Support\Facades\Http;
use App\Models\SmsIntegration;
use App\Models\CompanySettings;
use App\Models\Automation;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

function superadmin()
{
    $role = \Auth::user()->role_id;
    if (isset($role) && !empty($role)) {
        return false;
    }
    return true;
}

function client() {
    if( session()->has('client') ) {
        return session('client');
    }
    return false;
}

function clientRedirectLogin() {
    if( !session()->has('client') ) {
        redirect()->route('customer-login');
    }
}

function clientRedirectProfile() {
    // dd( Session::get('client'));
    if( session()->has('client') ) {
        redirect()->route('profile');
    }
}

function csettings($module)
{
    if( isset(auth()->user()->company_id ) ) {
        $company_info = CompanySettings::select($module)->where('id', auth()->user()->company_id)->first();
    } else {
        $company_info = CompanySettings::select($module)->where('site_code', request()->segment(1))->first();
    }
    
    if (isset($company_info) && !empty($company_info)) {
        return $company_info->$module ?? null;
    } else {
        return false;
    }
}

function capi($type, $field) {
    $api_info = ApiData::where(['type' => $type, 'field' => $field])->first();
    if( isset( $api_info ) && !empty( $api_info ) ) {
        return $api_info->field_value;
    } else  {
        return false;
    }
}

function automation($activity_type, $field)
{
    if (csettings('workflow_automation')) {

        //check activity type is exist yes or no
        $info = Automation::where('activity_type', $activity_type)->first();
        if (isset($info) && !empty($info) && hasPlanSettings('work_automation')) {
            return $info->$field ?? 0;
        } else {
            return false;
        }
    } else {
        return false;
    }
}


function hasPlanSettings($field)
{
    //check activity type is exist yes or no
    $info = Subscription::join('company_subscriptions', 'company_subscriptions.subscription_id','=','subscriptions.id')
            ->where('company_id', auth()->user()->company_id )->first();
    if (isset($info->$field) && $info->$field == 'yes') {
        return true;
    } else {
        return false;
    }
   
}


function sendSMS($mobile_no, $type, $params)
{
    $sms = SmsIntegration::where('sms_type', $type)->first();
    
    if (isset($sms) && !empty($sms)) {
        $templateMessage = $sms->template;
        $templateMessage = str_replace("{", "", addslashes($templateMessage));
        $templateMessage = str_replace("}", "", $templateMessage);
        extract($params);
        eval("\$templateMessage = \"$templateMessage\";");
        $http_query = "https://smshorizon.co.in/api/sendsms.php?user=$sms->user_name&apikey=$sms->api_key&mobile=$mobile_no&message=$templateMessage&senderid=$sms->sender_id&type=$sms->type&tid=$sms->template_id";
        $response = Http::get($http_query);
        return $response;
    }
}

function sendWhatsappApi($mobile_no, $type, $params, $from, $media_url = '', $filename = '') {
    $mobile_no = '91'.$mobile_no;
    $access_token = capi('whatsapp', 'access_token');
    $instance_id = capi('whatsapp', 'instance_id');
    if( $from == 'sms' ) {
        $sms = SmsIntegration::where('sms_type', $type)->first();
        if( isset( $sms ) && !empty( $sms ) ) {
            $message = $sms->template;
            $message = str_replace("{", "", addslashes($message));
            $message = str_replace("}", "", $message);
            extract($params);
            eval("\$message = \"$message\";");
        }
        
    } else if( $from == 'email' ) {
        $message = $params;
    } else if( $from == 'media' ) {
        $message = $params;
    }
   
    $api_type = 'text';
    if( $access_token && $instance_id ) {

        if( $from != 'media') {
            $http_query = "http://wase.co.in/api/send.php?number=$mobile_no&type=$api_type&message=$message&instance_id=$instance_id&access_token=$access_token";
            Log::info($http_query);
            $response = Http::get($http_query);
            Log::info($response);

        } else {
            $http_query = "http://wase.co.in/api/send.php?number=$mobile_no&type=text&message=$message&instance_id=$instance_id&access_token=$access_token";
            Log::info($http_query);
            $response = Http::get($http_query);
            $http_query = "http://wase.co.in/api/send.php?number=$mobile_no&type=media&message=$message&media_url=$media_url&filename=$filename&instance_id=$instance_id&access_token=$access_token";
            Log::info($http_query);
            $response = Http::get($http_query);
            Log::info($response);
        }
        
        return true;
    }
   
}

function getCompanyCode($code) {
    $date = date('Yi');
    $prefix = 'PX';
    $company_code = $prefix.'-'.$code.$date;

    $info = \DB::table('company_settings')->where('site_code', $company_code )->first();
    $is_exist = false;
    if( isset( $info ) && !empty( $info ) ) {
        $is_exist = true;
    }

    while ($is_exist) {
        getCompanyCode($code);
    }
    return $company_code;
}

function planSettings($field)
{
    //check activity type is exist yes or no
    $info = Subscription::join('company_subscriptions', 'company_subscriptions.subscription_id','=','subscriptions.id')
            ->where('company_id', auth()->user()->company_id )->first();
    if (isset($info->$field)) {
        return $info->$field;
    } else {
        return false;
    }
   
}

// function getDatabaseSize() {
//     // dd( $_SERVER );
//     $sizesInfo = DB::select('SELECT table_name AS "Table",
//     sum(ROUND(((data_length + index_length) / 1024 / 1024), 2)) AS "Size (MB)"
//     FROM information_schema.TABLES
//     WHERE table_schema = "laravelauth"
//     ORDER BY (data_length + index_length) DESC');
//     return $sizesInfo;
// }