<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriptions')->insert([
            'subscription_name' => "Free Trial",
            'subscription_period' => '15-D',
            'no_of_clients' => '10',
            'no_of_employees' => '10',
            'no_of_leads' => '10',
            'no_of_deals' => '10',
            'no_of_deal_stages' => '10',
            'no_of_email_templates' => '10',
            'no_of_pages' => '10',
            'no_of_sms_templates' => '10',
            'no_of_products' => '10',
            'bulk_import' => 'yes',
            'bulk_upload' => 'yes',
            'announcements' => 'yes',
            'predefined_configurations' => 'yes',
            'newletter_subscriptions' => 'yes',
            'tasks' => 'tes',
            'activities' => 'yes',
            'payment_tracking' => 'yes',
            'thirdparty_integration' => 'yes',
            'technical_support' => 'yes',
            'onetime_setup' => 'yes',
            'server_procurement' => 'yes',
            'server_space' => 10,
            'database_backup' => 'yes',
            'work_automation' => 'yes',
            'telegram_bot' => 'yes',
            'sms_integration' => 'yes',
            'payment_gateway' => 'ccavenue,razorpay,payu',
            'business_whatsapp' => 'yes',
            'amount' => 0,
            'status' => '1',
            'added_by' => '1',
            
        ]);
    }
}
