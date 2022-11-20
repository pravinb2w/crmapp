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
                'page_logo' => '/assets/images/logo/logo-color.png',
                'permalink' => 'lead-page' ,
                'page_type' => 'lead page' ,
                'mail_us' => 'info@lead.gmail.com' ,
                'call_us' => '9874561230' ,
                'contact_us' => 'N0.30/234 New Road, city - 600028' , 
                'iframe_tags'    => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4013544.104225399!2d76.0439680919549!3d10.774757347843204!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b00c582b1189633%3A0x559475cc463361f0!2sTamil%20Nadu!5e0!3m2!1sen!2sin!4v1647710624143!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'other_tags'     => '',
                'about_title'    => 'Who we are ? What we do..',
                'file_about'     => '/assets/images/about.png',
                'about_content'  => 'Behind every great human achievement, there is a team. 
                                    From medicine and space travel, to disaster response and pizza deliveries, our products help teams all over the planet advance humanity through the power of software.
                                    Our mission is to help unleash the potential of every team. </br>
                                    Behind every great human achievement, there is a team. 
                                    From medicine and space travel, to disaster response and pizza deliveries, our products help teams all over the planet advance humanity through the power of software.
                                    Our mission is to help unleash the potential of every team.
                                    ',
                'primary_color'  => '#00BFFF',
                'secondary_color'=> '#002D86',
                'company_id' => 1
            ] 
        ];
        $data_banner = [
            [
                'page_id'       =>  1,
                'title'         =>  'Responsive Theme Perfect for Downloding Your App!',
                'sub_title'     =>  'Incredible' ,
                'image'         =>  'https://images.unsplash.com/photo-1551033541-2075d8363c66?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1yZWxhdGVkfDV8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60' ,
                'content'       =>  'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus.' ,
                'company_id' => 1
            ],
            [
                'page_id'       =>  1,
                'title'         =>  'Responsive Theme Perfect for Downloding OUR CRM!',
                'sub_title'     =>  'Incredible' ,
                'image'         =>  'https://images.unsplash.com/photo-1619597455322-4fbbd820250a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1yZWxhdGVkfDE2fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60' ,
                'content'       =>  'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus.' ,
                'company_id' => 1
            ],
        ];
        $data_input = [
            [
                'page_id' => 1,
                'input_type' => 'fullname',
                'input_required' => '1' ,
                'company_id' => 1

            ] ,
            [
                'page_id' => 1,
                'input_type' => 'email',
                'input_required' => '1' ,
                'company_id' => 1

            ] ,
            [
                'page_id' => 1,
                'input_type' => 'mobile_no',
                'input_required' => '1',
                'company_id' => 1

            ] ,
            [
                'page_id' => 1,
                'input_type' => 'subject',
                'input_required' => '0',
                'company_id' => 1

            ] ,
            [
                'page_id' => 1,
                'input_type' => 'message',
                'input_required' => '0' ,
                'company_id' => 1

            ] 
        ];
        $data_media = [
            [
                'page_id' => 1,
                'name' => 'Instagram',
                'link' => 'https://www.instagram.com/',
                'icon' => '0',
                'company_id' => 1

            ] ,
            [
                'page_id' => 1,
                'name' => 'Facebook',
                'link' => 'https://www.facebook.com/',
                'icon' => '0',
                'company_id' => 1

            ] ,
            [
                'page_id' => 1,
                'name' => 'YouTube',
                'link' => 'https://www.youtube.com/',
                'icon' => '0',
                'company_id' => 1

            ] ,
        ];
        $data_feature = [
            [
                'page_id'   => 1,
                'icon'      => 'https://cdn-icons-png.flaticon.com/512/3174/3174745.png',
                'title'     => 'Quality Resources',
                'content'   => 'Sed ut perspiciatis remque laudan unde omnis iste natus error sit voluptatem accusantium dolo remque laudan tiuotam.',
                'company_id' => 1
            ],
            [
                'page_id'   => 1,
                'icon'      => 'https://cdn-icons-png.flaticon.com/512/3174/3174763.png',
                'title'     => 'At solmen va esser',
                'content'   => 'Sed ut perspiciatis remque laudan unde omnis iste natus error sit voluptatem accusantium dolo remque laudan tiuotam.',
                'company_id' => 1
            ],
            [
                'page_id'   => 1,
                'icon'      => 'https://cdn-icons-png.flaticon.com/512/3174/3174755.png',
                'title'     => 'Quality Resources',
                'content'   => 'Sed ut perspiciatis remque laudan unde omnis iste natus error sit voluptatem accusantium dolo remque laudan tiuotam.',
                'company_id' => 1
            ],
            [
                'page_id'   => 1,
                'icon'      => 'https://cdn-icons-png.flaticon.com/512/3174/3174727.png',
                'title'     => 'At solmen va esser',
                'content'   => 'Sed ut perspiciatis remque laudan unde omnis iste natus error sit voluptatem accusantium dolo remque laudan tiuotam.',
                'company_id' => 1
            ],
            [
                'page_id'   => 1,
                'icon'      => 'https://cdn-icons-png.flaticon.com/512/3174/3174725.png',
                'title'     => 'Quality Resources',
                'content'   => 'Sed ut perspiciatis remque laudan unde omnis iste natus error sit voluptatem accusantium dolo remque laudan tiuotam.',
                'company_id' => 1
            ],
            [
                'page_id'   => 1,
                'icon'      => 'https://cdn-icons-png.flaticon.com/512/3174/3174753.png',
                'title'     => 'At solmen va esser',
                'content'   => 'Sed ut perspiciatis remque laudan unde omnis iste natus error sit voluptatem accusantium dolo remque laudan tiuotam.',
                'company_id' => 1
            ],
        ];
        \DB::table('landing_pages')->insert($data);
        \DB::table('landing_page_banner_sliders')->insert($data_banner);
        \DB::table('landing_page_form_inputs')->insert($data_input);
        \DB::table('landing_page_social_medias')->insert($data_media);
        \DB::table('landing_page_features')->insert($data_feature);

    }
}
