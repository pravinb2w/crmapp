<?php

use App\Models\ApiData;
use Illuminate\Support\Facades\Http;
use App\Models\SmsIntegration;
use App\Models\CompanySettings;
use App\Models\Automation;
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
    $company_info = CompanySettings::select($module)->first();
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
        if (isset($info) && !empty($info)) {
            return $info->$field ?? 0;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function sendSMS($mobile_no, $type, $params)
{
    $sms = SmsIntegration::where('sms_type', $type)->first();
    $templateMessage = $sms->template;
    $templateMessage = str_replace("{", "", addslashes($templateMessage));
    $templateMessage = str_replace("}", "", $templateMessage);
    extract($params);
    eval("\$templateMessage = \"$templateMessage\";");
    if (isset($sms) && !empty($sms)) {
        $http_query = "https://smshorizon.co.in/api/sendsms.php?user=$sms->user_name&apikey=$sms->api_key&mobile=$mobile_no&message=$templateMessage&senderid=$sms->sender_id&type=$sms->type&tid=$sms->template_id";
        $response = Http::get($http_query);
        return $response;
    }
}

function sendWhatsappApi($mobile_no, $type = null, $params, $from, $media_url = '', $filename = '') {
    $mobile_no = '91'.$mobile_no;
    $access_token = capi('whatsapp', 'access_token');
    $instance_id = capi('whatsapp', 'instance_id');
    if( $from == 'sms' ) {
        $sms = SmsIntegration::where('sms_type', $type)->first();
        $message = $sms->template;
        $message = str_replace("{", "", addslashes($message));
        $message = str_replace("}", "", $message);
        extract($params);
        eval("\$message = \"$message\";");
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
        } else {
            $http_query = "http://wase.co.in/api/send.php?number=$mobile_no&type=text&message=$message&instance_id=$instance_id&access_token=$access_token";
            Log::info($http_query);
            $response = Http::get($http_query);
            $http_query = "http://wase.co.in/api/send.php?number=$mobile_no&type=media&message=$message&media_url=$media_url&filename=$filename&instance_id=$instance_id&access_token=$access_token";
            Log::info($http_query);
            $response = Http::get($http_query);
        }
        
        return true;
    }
   
}