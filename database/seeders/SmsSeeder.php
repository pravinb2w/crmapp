<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sms_integrations')->insert([
            
        [
            'company_id' => "1",
            'sms_type' => 'new_registration',
            'user_name' => 'stockphoenix',
            'api_key' => 'k5RWlTshSVTDa3rfETQ2',
            'template' => 'Use Your Mobile no/ Email as the User Name. Your Password is {$password} Phoenix Technologies Family Welcomes You', 
            'sender_id' => 'PHXTEC', 
            'template_id' => '1207165778661277349',
            'type' => 'txt',
            'variables' => 'password',
            'twilio_sid' => null,
            'twilio_auth_token' => null,
            'twilio_number' => null,
            'enable_twilio' => null
        ],[
            'company_id' => "1",
            'sms_type' => 'otp_login',
            'user_name' => 'stockphoenix',
            'api_key' => 'k5RWlTshSVTDa3rfETQ2',
            'template' => 'Your OTP is {$otp} for log in. Phoenix Technologies Family Welcomes You.', 
            'sender_id' => 'PHXTEC', 
            'template_id' => '1207165830769496643',
            'type' => 'txt',
            'variables' => 'otp',
            'twilio_sid' => null,
            'twilio_auth_token' => null,
            'twilio_number' => null,
            'enable_twilio' => null
        ]
        ]);

        DB::table('api_data')->insert([
            [
                'type' => 'whatsapp',
                'field' => 'access_token',
                'field_value' => 'c1894f0cf0eb156a75cd686b7c8a92d1',
                'status' => 1
            ],
            [
                'type' => 'whatsapp',
                'field' => 'instance_id',
                'field_value' => '62FC86AA43296',
                'status' => 1
            ]
        ]);

        DB::table('automations')->insert([
            [
                'company_id' => 1,
                'activity_type' => 'New Deal Addition',
                'activity_title' => NULL,
                'description' => NULL,
                'template_id' => NULL,
                'is_mail_to_customer' => 0,
                'team_template_id' => null,
                'is_mail_to_team' => 1,
                'is_notification_to_team' => 1,
                'notification_title' => 'New Deal Addition',
                'notification_message' => 'Durai testing team iwth message',
                'status' => 1,
                'added_by' => 1
            ],
            [
                'company_id' => 1,
                'activity_type' => 'Activity on all Leads',
                'activity_title' => NULL,
                'description' => NULL,
                'template_id' => 1,
                'is_mail_to_customer' => 1,
                'team_template_id' => 2,
                'is_mail_to_team' => 0,
                'is_notification_to_team' => 0,
                'notification_title' => null,
                'notification_message' => null,
                'status' => 1,
                'added_by' => 1
            ],
            [
                'company_id' => 1,
                'activity_type' => 'New Lead Addition',
                'activity_title' => NULL,
                'description' => NULL,
                'template_id' => 11,
                'is_mail_to_customer' => 1,
                'team_template_id' => 10,
                'is_mail_to_team' => 0,
                'is_notification_to_team' => 0,
                'notification_title' => 'Hi Team - new lead has come',
                'notification_message' => 'WElome to new leads',
                'status' => 1,
                'added_by' => 1
            ],
            [
                'company_id' => 1,
                'activity_type' => 'Conversion from Lead to Deal',
                'activity_title' => NULL,
                'description' => NULL,
                'template_id' => null,
                'is_mail_to_customer' => 1,
                'team_template_id' => null,
                'is_mail_to_team' => 1,
                'is_notification_to_team' => 1,
                'notification_title' => null,
                'notification_message' => null,
                'status' => 1,
                'added_by' => 1
            ],
            [
                'company_id' => 1,
                'activity_type' => 'Activity on all Deals',
                'activity_title' => NULL,
                'description' => NULL,
                'template_id' => null,
                'is_mail_to_customer' => 0,
                'team_template_id' => null,
                'is_mail_to_team' => 1,
                'is_notification_to_team' => 1,
                'notification_title' => null,
                'notification_message' => null,
                'status' => 1,
                'added_by' => 1
            ],
            [
                'company_id' => 1,
                'activity_type' => 'Deal stage changed',
                'activity_title' => NULL,
                'description' => NULL,
                'template_id' => null,
                'is_mail_to_customer' => 0,
                'team_template_id' => null,
                'is_mail_to_team' => 1,
                'is_notification_to_team' => 1,
                'notification_title' => null,
                'notification_message' => null,
                'status' => 1,
                'added_by' => 1
            ],
            [
                'company_id' => 1,
                'activity_type' => 'Deal won/lose',
                'activity_title' => NULL,
                'description' => NULL,
                'template_id' => null,
                'is_mail_to_customer' => 1,
                'team_template_id' => null,
                'is_mail_to_team' => 1,
                'is_notification_to_team' => 1,
                'notification_title' => null,
                'notification_message' => null,
                'status' => 1,
                'added_by' => 1
            ],
            [
                'company_id' => 1,
                'activity_type' => 'Invoice Creation',
                'activity_title' => NULL,
                'description' => NULL,
                'template_id' => null,
                'is_mail_to_customer' => 1,
                'team_template_id' => null,
                'is_mail_to_team' => 1,
                'is_notification_to_team' => 1,
                'notification_title' => null,
                'notification_message' => null,
                'status' => 1,
                'added_by' => 1
            ],
            [
                'company_id' => 1,
                'activity_type' => 'Thanks mail for the payment received',
                'activity_title' => NULL,
                'description' => NULL,
                'template_id' => null,
                'is_mail_to_customer' => 1,
                'team_template_id' => null,
                'is_mail_to_team' => 1,
                'is_notification_to_team' => 1,
                'notification_title' => null,
                'notification_message' => null,
                'status' => 1,
                'added_by' => 1
            ],
            [
                'company_id' => 1,
                'activity_type' => 'New Customer Addition',
                'activity_title' => NULL,
                'description' => NULL,
                'template_id' => null,
                'is_mail_to_customer' => 1,
                'team_template_id' => null,
                'is_mail_to_team' => 1,
                'is_notification_to_team' => 1,
                'notification_title' => null,
                'notification_message' => null,
                'status' => 1,
                'added_by' => 1
            ],
            [
                'company_id' => 1,
                'activity_type' => 'New Organization Addition',
                'activity_title' => NULL,
                'description' => NULL,
                'template_id' => null,
                'is_mail_to_customer' => 1,
                'team_template_id' => null,
                'is_mail_to_team' => 1,
                'is_notification_to_team' => 1,
                'notification_title' => null,
                'notification_message' => null,
                'status' => 1,
                'added_by' => 1
            ]
        ]);
    }
}
