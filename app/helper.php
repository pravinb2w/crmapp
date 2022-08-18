<?php

use Illuminate\Support\Facades\Http;
use App\Models\SmsIntegration;
use App\Models\CompanySettings;
use App\Models\Automation;

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

// *********** Crypto CCAvenue Function *********************

function encrypt_crypto($plainText, $key)
{
    $secretKey = hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $encryptedText = openssl_encrypt($plainText, "AES-128-CBC", $secretKey, OPENSSL_RAW_DATA, $initVector);
    $encryptedText = bin2hex($encryptedText);
    return $encryptedText;
}

function decrypt_crypto($encryptedText, $key)
{
    $secretKey         = hextobin(md5($key));
    $initVector         =  pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $encryptedText      = hextobin($encryptedText);
    $decryptedText         =  openssl_decrypt($encryptedText, "AES-128-CBC", $secretKey, OPENSSL_RAW_DATA, $initVector);
    return $decryptedText;
}

// *********** Padding Function *********************
function pkcs5_pad($plainText, $blockSize)
{
    $pad = $blockSize - (strlen($plainText) % $blockSize);
    return $plainText . str_repeat(chr($pad), $pad);
}

// ********** Hexadecimal to Binary function for php 4.0 version ********
function hextobin($hexString)
{
    $length = strlen($hexString);
    $binString = "";
    $count = 0;
    while ($count < $length) {
        $subString = substr($hexString, $count, 2);
        $packedString = pack("H*", $subString);
        if ($count == 0) {
            $binString = $packedString;
        } else {
            $binString .= $packedString;
        }

        $count += 2;
    }
    return $binString;
}