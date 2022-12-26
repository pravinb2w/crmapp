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

        
    }
}
