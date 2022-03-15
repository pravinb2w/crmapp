<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Models\User;
use App\Models\CompanySettings;
use App\Models\PrefixSetting;
use Illuminate\Support\Facades\Hash;


class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $type = $request->segment(2);
        $url = 'change';
        if( empty($type) ){
            $url = 'profile';
        }
        $params['type'] = $url;
        return view('crm.account.account_index', $params);
    }

    public function get_settings_tab(Request $request)
    {
        $type = $request->type;
        $id = Auth::id();
        $info = User::find($id);
        $prefix = PrefixSetting::where(['company_id' => $info->company_id, 'status' => 1])->get();
        $params = ['type' => $type, 'info' => $info, 'prefix' => $prefix];
        $view = 'crm.account._account_'.$type;
        return view($view, $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        $type = $request->type;

        if( $type == 'profile' ) {
            $validator   = [
                'first_name'      => [ 'required', 'string', 'max:255' ],
                'email'      => [ 'required', 'string', 'max:255' ],
                'mobile_no'      => [ 'required', 'string', 'max:255' ],
                'profile_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg']
            ];
        }
        //Validate the product
        $validator                     = Validator::make( $request->all(), $validator );
        
        if ($validator->passes()) {
            $id = Auth::id();
            $user = User::find($id);
            $user->name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->mobile_no = $request->mobile_no;
            if( $request->hasFile( 'profile_image' ) ) {
                $file                       = $request->file( 'profile_image' )->store( 'account', 'public' );
                $user->image                  = $file;
            }
            $user->save();
            $success = 'Account settings saved';
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function company_save(Request $request)
    {
        $type = $request->type;
        if( isset($type ) && ( $type != 'api' && $type != 'link' && $type != 'prefix')) {
            if( $type == 'company' ) {
                $validator   = [
                    'site_name' => [ 'required', 'string', 'max:255' ],
                    'site_logo' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
                    'site_favicon' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
                ];
            } else if( $type == 'mail') {
                $validator   = [
                    'smtp_host' => [ 'required', 'string', 'max:255' ],
                    'smtp_port' => ['required', 'max:5'],
                    'smtp_user' => ['required', 'string', 'max:55'],
                    'smtp_password' => ['required', 'string', 'max:55'],
                ];
            } else {
                $validator   = [
                    'current_password' => [ 'required', 'string', 'max:255' ],
                    'password' => ['required', 'confirmed', 'min:8'],
                    'password_confirmation' => ['required', 'min:8'],
                ];
            }
            
            //Validate the product
            $validator                     = Validator::make( $request->all(), $validator );
            
            if ($validator->passes()) {
                $id = Auth::id();
                
                $user = User::find($id);
                $sett = CompanySettings::find($user->company_id);
                if( $type == 'company' ) {
                    $sett->site_name = $request->site_name;
                    $sett->site_url = $request->site_url;
                    $sett->copyrights = $request->copyrights;
                    $sett->site_email = $request->site_email;
                    $sett->site_phone = $request->site_phone;
                    $sett->office_time = $request->office_time;
                    $sett->address = $request->address;

                    if( $request->hasFile( 'site_logo' ) ) {
                        $file                       = $request->file( 'site_logo' )->store( 'account', 'public' );
                        $sett->site_logo            = $file;
                    }
                    if( $request->hasFile( 'site_favicon' ) ) {
                        $file                       = $request->file( 'site_favicon' )->store( 'account', 'public' );
                        $sett->site_favicon         = $file;
                    }
                    $sett->update();
                    $success = 'Account settings saved';
                    return response()->json(['error'=>[$success], 'status' => '0']);
                } else if($type == 'mail') {
                    $sett->smtp_host = $request->smtp_host;
                    $sett->smtp_port = $request->smtp_port;
                    $sett->smtp_user = $request->smtp_user;
                    $sett->smtp_password = $request->smtp_password;
                    $sett->mailer = $request->mailer;
                    $sett->mail_encryption = $request->mail_encryption;
                    $sett->update();
                    $success = 'Account settings saved';
                    return response()->json(['error'=>[$success], 'status' => '0']);
                } else {
                    if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
                        // The passwords matches
                        $success = 'Current password does not match with this password';
                        return response()->json(['error'=>[$success], 'status' => '1']);
                    }
                    $user->password = Hash::make($request->password);
                    $user->save();
                    $success = 'Password changed successfully';
                    return response()->json(['error'=>[$success], 'status' => '0']);
                }
                
                
            }
            return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
        } else {
            $id = Auth::id();
            $user = User::find($id);
            $sett = CompanySettings::find($user->company_id);

            if( $type == 'api') {
                $sett->aws_access_key = $request->aws_access_key;
                $sett->aws_secret_key = $request->aws_secret_key;
                $sett->fcm_token = $request->fcm_token;
                $sett->update();

            } else if($type == 'link') {
                $sett->facebook_url = $request->facebook_url;
                $sett->twitter_url = $request->twitter_url;
                $sett->instagram_url = $request->instagram_url;
                $sett->update();

            } else if( $type == 'prefix' ) {

                $prefix_field = $request->prefix_field;
                $prefix_value = $request->prefix_value;
                $prefix_id = $request->prefix_id;
                $tmp = [];
                for ($i=0; $i < count($prefix_field); $i++) { 
                    $tmp[] = [ 'id' => $prefix_id[$i] ?? '', 'prefix_field' => $prefix_field[$i], 'prefix_value' => $prefix_value[$i]];
                }
                
                if( !empty($tmp)) {
                    foreach ($tmp as $key => $value) {
                        if( isset( $value['id'] ) && !empty($value['id']) ){
                            $pref = PrefixSetting::find($value['id']);
                            $pref->prefix_field = $value['prefix_field'];
                            $pref->prefix_value = $value['prefix_value'];
                            $pref->update();
                        } else {
                            $ins[ 'prefix_field'] = $value['prefix_field'];
                            $ins[ 'prefix_value'] = $value['prefix_value'];
                            $ins[ 'status'] = 1;
                            $ins['company_id'] = $user->company_id;
                            PrefixSetting::create($ins);
                        }
                    }
                }
            }
            $success = 'Account settings saved';
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        
    }
}
