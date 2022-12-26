<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_settings')->insert([
            'site_name' => "PhoenixCRM",
            'site_code' => 'PXM00012022',
            'status' => 1,
            'is_owner' => 1,
            'lead_access' => 'visibileall', 
            'deal_access' => 'visibileall', 
            'workflow_automation' => 1,
            'mailer' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => '587',
            'smtp_user' => 'phoenixtechnologies2022@gmail.com',
            'smtp_password' => 'opheheeakfcfieux',
            'mail_encryption' => 'tls',
        ]);
    }
}
