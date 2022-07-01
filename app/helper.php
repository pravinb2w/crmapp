<?php

use Illuminate\Support\Facades\Http;
use App\Models\SmsIntegration;
use App\Models\CompanySettings;


function superadmin()
{
    $role = \Auth::user()->role_id;
    if (isset($role) && !empty($role)) {
        return false;
    }
    return true;
}

function csettings($module)
{
    $company_info = CompanySettings::select($module)->first();
    if (isset($company_info) && !empty($company_info)) {
        return $company_info->$module;
    } else {
        return false;
    }
}

function automation()
{
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
