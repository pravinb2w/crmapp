<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'page_title' => 'Lead creation Page',
                'page_logo' => 'LandingPages/Logos/cparS00eCtCIETaWaxSOYJc1EXy4czy75Irdw5MY.png',
                'permalink' => 'lead-page' ,
                'mail_us' => 'info@lead.gmail.com' ,
                'call_us' => '9874561230' ,
                'contact_us' => 'N0.30/234 New Road, city - 600028' , 
            ] 
        ];
        \DB::table('landing_pages')->insert($data);
    }
}
