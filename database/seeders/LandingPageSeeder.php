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
        $data_banner = [
            [
                'page_id'       =>  1,
                'title'         =>  'Responsive Theme Perfect for Downloding Your App!',
                'sub_title'     =>  'Incredible' ,
                'image'         =>  'LandingPages/Banners/bg-2.jpg' ,
                'content'       =>  'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus.' ,
            ],
            [
                'page_id'       =>  1,
                'title'         =>  'Responsive Theme Perfect for Downloding OUR CRM!',
                'sub_title'     =>  'Incredible' ,
                'image'         =>  'LandingPages/Banners/bg.jpg' ,
                'content'       =>  'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus.' ,
            ],
        ];
        $data_input = [
            [
                'page_id' => 1,
                'input_type' => 'fullname',
                'input_required' => '1' 
            ] ,
            [
                'page_id' => 1,
                'input_type' => 'email',
                'input_required' => '1' 
            ] ,
            [
                'page_id' => 1,
                'input_type' => 'mobile_no',
                'input_required' => '1' 
            ] ,
            [
                'page_id' => 1,
                'input_type' => 'subject',
                'input_required' => '0' 
            ] ,
            [
                'page_id' => 1,
                'input_type' => 'message',
                'input_required' => '0' 
            ] 
        ];
        $data_media = [
            [
                'page_id' => 1,
                'name' => 'Instagram',
                'link' => '#',
                'icon' => '0' 
            ] ,
            [
                'page_id' => 1,
                'name' => 'Facebook',
                'link' => '#',
                'icon' => '0' 
            ] ,
            [
                'page_id' => 1,
                'name' => 'YouTube',
                'link' => '#',
                'icon' => '0' 
            ] ,
        ];
        \DB::table('landing_pages')->insert($data);
        \DB::table('landing_page_banner_sliders')->insert($data_banner);
        \DB::table('landing_page_form_inputs')->insert($data_input);
        \DB::table('landing_page_social_medias')->insert($data_media);



    }
}
