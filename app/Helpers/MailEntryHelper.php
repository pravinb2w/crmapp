<?php

namespace App\Helpers;

use App\Models\CompanySettings;
use App\Models\Lead;
use App\Models\SendMail;

class MailEntryHelper
{
    public static function welcomeMessage($lead_id = null, $to_email)
    {
        $company = CompanySettings::find(1);

        $extract = array(
            'app_name' => env('APP_NAME'),
            'mentorship_link' => $company->mentorship_link ?? '',
            'telegram_bot' => $company->telegram_bot ?? '',
            'testimonial_link' => $company->testimonial_link ?? '',
            'youtube_learning_link' => $company->youtube_learning_link ?? '',
            'company_phone_no' => $company->site_phone,
            'company_name' => $company->site_name,
            'company_url' => $company->site_url
        );

        $ins_mail = array(
            'type' => 'lead',
            'type_id' => $lead_id,
            'email_type' => 'new_registration',
            'params' => serialize($extract),
            'to' => $to_email ?? 'duraibytes@gmail.com'
        );
        if (automation('New Lead Addition', 'is_mail_to_customer')) {
            SendMail::create($ins_mail);
        }
    }

    public static function leadAddition($lead_id, $to_email)
    {
        $company = CompanySettings::find(1);

        $extract = array(
            'app_name' => env('APP_NAME'),
            'mentorship_link' => $company->mentorship_link ?? '',
            'telegram_bot_link' => $company->telegram_bot ?? '',
            'telegram_link' => $company->telegram_link ?? '',
            'youtube_learning_link' => $company->youtube_learning_link ?? '',
            'company_name' => $company->site_name,
        );

        $ins_mail = array(
            'type' => 'lead',
            'type_id' => $lead_id,
            'email_type' => 'new_lead',
            'params' => serialize($extract),
            'to' => $to_email ?? 'duraibytes@gmail.com'
        );
        if (automation('New Lead Addition', 'is_mail_to_customer')) {
            SendMail::create($ins_mail);
        }
    }

    public static function dealConversion($lead_id, $to_email)
    {
        $company = CompanySettings::find(1);
        $lead_info = Lead::find($lead_id);
        $extract = array(
            'app_name' => env('APP_NAME'),
            'lead_product' => $lead_info->lead_subject,
            'company_name' => $company->site_name,
        );

        $ins_mail = array(
            'type' => 'lead',
            'type_id' => $lead_id,
            'email_type' => 'deal_conversion',
            'params' => serialize($extract),
            'to' => $to_email ?? 'duraibytes@gmail.com'
        );
        if (automation('Conversion from Lead to Deal', 'is_mail_to_customer')) {
            SendMail::create($ins_mail);
        }
    }
}