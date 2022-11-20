<?php

namespace App\Http\Controllers;

use App\Models\CompanySettings;
use App\Models\CompanySubscription;
use App\Models\LandingPages;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function registerForm(Request $request)
    {
        $welcome_title = 'Register';
        return view('auth.register', compact('welcome_title'));
    }

    public function getCompanyCode(Request $request)
    {

        $company_name   = $request->companyName;
        $companyCode    = $request->companyCode;
        $email          = $request->email;
        if( isset( $companyCode ) && !empty( $companyCode ) ) {
            $info = CompanySettings::where('site_code', $companyCode)->first();
            if( isset( $info ) && !empty( $info ) ) {
                echo 1;die;
            }
            echo 2;die;
        } else if( isset( $email ) && !empty( $email )) {
            $info = CompanySettings::where('site_email', $email)->first();
            if( isset( $info ) && !empty( $info ) ) {
                echo 1;die;
            }
            echo 2;die;
        } else {
            $company_code = substr($company_name, 0, 3);

            $code = getCompanyCode(strtoupper($company_code));
            return $code;
        }

    }

    public function saveRegisterForm(Request $request)
    {

        $company_name = $request->company_name;
        $company_code = $request->company_code;
        $email = $request->email;
        $contact = $request->contact;
        $admin_email = $request->admin_email;
        $password = $request->password;
        //create company settings
        $ins[ 'site_name' ]     = $company_name;
        $ins[ 'site_code' ]     = $company_code;
        $ins[ 'site_email' ]    = $email;
        $ins[ 'site_phone' ]    = $contact;
        $ins[ 'status' ]        = 1;

        $info = CompanySettings::create($ins);
        $subsInfo = Subscription::where('subscription_name', 'Free Trial')->first();
        $subsDay = explode('-',$subsInfo->subscription_period);
        $num = current($subsDay);
        $period = end($subsDay);
        $periodDays = $num;
        if( strtolower($period) == 'm' ) {
            $periodDays = $num * 30;
        } else if( strtolower($period) == 'y') {
            $periodDays = $num * 365;
        }

        $subsIns[ 'subscription_id' ] = $subsInfo->id;
        $subsIns[ 'company_id' ] = $info->id;
        $subsIns[ 'is_trail' ] = 'yes';
        $subsIns[ 'startAt' ] = date('Y-m-d');
        $subsIns[ 'endAt' ] = date('y-m-d', strtotime('+ '.$periodDays.' days') );
        $subsIns[ 'expiry_remainder_days' ] = '';
        $subsIns[ 'status' ] = '1';
        $comSubsInfo = CompanySubscription::create($subsIns); 

        $info->subscription_id = $comSubsInfo->id;
        $info->save();

        $prefix = substr($company_name, 0, 3);
        $ins = [
            [
                'prefix_field' => 'Product',
                'prefix_value' => $prefix.'PD/'.date('Y').'/0000',
                'status' => 1,
                'company_id' => $info->id,
            ],
            [
                'prefix_field' => 'Lead',
                'prefix_value' => $prefix.'LD/'.date('Y').'/0000',
                'company_id' => $info->id,
                'status' => 1,
            ],
            [
                'prefix_field' => 'Invoice',
                'prefix_value' => $prefix.'INV/'.date('Y').'/0000',
                'company_id' => $info->id,
                'status' => 1,
            ]
        ];
        DB::table('prefix_settings')->insert($ins);

        $userInfo =User::create([
            'name' => "Admin",
            'email' => $admin_email,
            'password' => Hash::make($password),
            'company_id' => $info->id,
            'status' => 1,
        ]);


        $insOrder = [
            [
                'content' => 'mytask',
                'position' => 'left',
                'company_id' => $info->id,
            ],
            [
                'content' => 'alltask',
                'position' => 'bottom-left',
                'company_id' => $info->id,
            ],
            [
                'content' => 'closingweek',
                'position' => 'right',
                'company_id' => $info->id,
            ],
            [
                'content' => 'mytask',
                'position' => 'bottom-right',
                'company_id' => $info->id,
            ]
        ];
        DB::table('dashboard_orders')->insert($insOrder);
       
        $data = [
        
            'page_title' => 'Free Trial Landing Page',
            'page_logo' => '/assets/images/logo/logo-color.png',
            'permalink' => 'lead-page' ,
            'page_type' => 'lead page' ,
            'mail_us' => 'freetrial@lead.gmail.com' ,
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
            'is_default_landing_page' => 1,
            'company_id' => $info->id
            
        ];
        $pageInfo = LandingPages::create($data);

        $data_banner = [
            [
                'page_id'       =>  $pageInfo->id,
                'title'         =>  'Free Trial App!',
                'sub_title'     =>  'Incredible' ,
                'image'         =>  'https://images.unsplash.com/photo-1551033541-2075d8363c66?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1yZWxhdGVkfDV8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60' ,
                'content'       =>  'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus.' ,
                'company_id' => $info->id
            ],
            [
                'page_id'       =>  $pageInfo->id,
                'title'         =>  'Free Trial for Downloding OUR CRM!',
                'sub_title'     =>  'Incredible' ,
                'image'         =>  'https://images.unsplash.com/photo-1619597455322-4fbbd820250a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1yZWxhdGVkfDE2fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60' ,
                'content'       =>  'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus.' ,
                'company_id' => $info->id
            ],
        ];
        $data_input = [
            [
                'page_id' => $pageInfo->id,
                'input_type' => 'fullname',
                'input_required' => '1' ,
                'company_id' => $info->id

            ] ,
            [
                'page_id' => $pageInfo->id,
                'input_type' => 'email',
                'input_required' => '1' ,
                'company_id' => $info->id

            ] ,
            [
                'page_id' => $pageInfo->id,
                'input_type' => 'mobile_no',
                'input_required' => '1',
                'company_id' => $info->id

            ] ,
            [
                'page_id' => $pageInfo->id,
                'input_type' => 'subject',
                'input_required' => '0',
                'company_id' => $info->id

            ] ,
            [
                'page_id' => $pageInfo->id,
                'input_type' => 'message',
                'input_required' => '0' ,
                'company_id' => $info->id

            ] 
        ];
        $data_media = [
            [
                'page_id' => $pageInfo->id,
                'name' => 'Instagram',
                'link' => 'https://www.instagram.com/',
                'icon' => '0',
                'company_id' => $info->id

            ] ,
            [
                'page_id' => $pageInfo->id,
                'name' => 'Facebook',
                'link' => 'https://www.facebook.com/',
                'icon' => '0',
                'company_id' => $info->id

            ] ,
            [
                'page_id' => $pageInfo->id,
                'name' => 'YouTube',
                'link' => 'https://www.youtube.com/',
                'icon' => '0',
                'company_id' => $info->id

            ] ,
        ];
        $data_feature = [
            [
                'page_id'   => $pageInfo->id,
                'icon'      => 'https://cdn-icons-png.flaticon.com/512/3174/3174745.png',
                'title'     => 'Quality Resources',
                'content'   => 'Sed ut perspiciatis remque laudan unde omnis iste natus error sit voluptatem accusantium dolo remque laudan tiuotam.',
                'company_id' => $info->id
            ],
            [
                'page_id'   => $pageInfo->id,
                'icon'      => 'https://cdn-icons-png.flaticon.com/512/3174/3174763.png',
                'title'     => 'At solmen va esser',
                'content'   => 'Sed ut perspiciatis remque laudan unde omnis iste natus error sit voluptatem accusantium dolo remque laudan tiuotam.',
                'company_id' => $info->id
            ],
            [
                'page_id'   => $pageInfo->id,
                'icon'      => 'https://cdn-icons-png.flaticon.com/512/3174/3174755.png',
                'title'     => 'Quality Resources',
                'content'   => 'Sed ut perspiciatis remque laudan unde omnis iste natus error sit voluptatem accusantium dolo remque laudan tiuotam.',
                'company_id' => $info->id
            ],
            [
                'page_id'   => $pageInfo->id,
                'icon'      => 'https://cdn-icons-png.flaticon.com/512/3174/3174727.png',
                'title'     => 'At solmen va esser',
                'content'   => 'Sed ut perspiciatis remque laudan unde omnis iste natus error sit voluptatem accusantium dolo remque laudan tiuotam.',
                'company_id' => $info->id
            ],
            [
                'page_id'   => $pageInfo->id,
                'icon'      => 'https://cdn-icons-png.flaticon.com/512/3174/3174725.png',
                'title'     => 'Quality Resources',
                'content'   => 'Sed ut perspiciatis remque laudan unde omnis iste natus error sit voluptatem accusantium dolo remque laudan tiuotam.',
                'company_id' => $info->id
            ],
            [
                'page_id'   => $pageInfo->id,
                'icon'      => 'https://cdn-icons-png.flaticon.com/512/3174/3174753.png',
                'title'     => 'At solmen va esser',
                'content'   => 'Sed ut perspiciatis remque laudan unde omnis iste natus error sit voluptatem accusantium dolo remque laudan tiuotam.',
                'company_id' => $info->id
            ],
        ];
        DB::table('landing_page_banner_sliders')->insert($data_banner);
        DB::table('landing_page_form_inputs')->insert($data_input);
        DB::table('landing_page_social_medias')->insert($data_media);
        DB::table('landing_page_features')->insert($data_feature);

        echo route('login', $company_code);die;
    }

    public function companyNotFound(Request $request)
    {
        $welcome_title  = 'Company Not Found';
        $error_title    = 'Company Code not found';
        $error_message  = 'Your company has not found. Please register to continue';
        return view('landing.page_not_found', compact('welcome_title','error_message','error_title'));
    }

    public function subscriptionNotFound(Request $request)
    {
        $welcome_title  = 'Subscription Not Found';
        $error_title    = 'Subscription not found';
        $error_message  = 'Your Subscription has not found or Expired. Please contact administrator to continue';
        return view('landing.page_not_found', compact('welcome_title','error_message','error_title'));
    }
}
