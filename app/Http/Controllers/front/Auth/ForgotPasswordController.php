<?php

namespace App\Http\Controllers\front\Auth;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\LandingPages;
use DB; 
use Carbon\Carbon; 
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Mail; 
use Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request; 


class ForgotPasswordController extends Controller
{
    public function send_reset_link(Request $request)
    {

        $role_validator   = [
            'email' => 'required|email|exists:customers',
        ];
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {
            $token = Str::random(64);

            DB::table('customer_password_resets')->insert([
                'email' => $request->email, 
                'token' => $token, 
                'created_at' => Carbon::now()
              ]);
    
            CommonHelper::setMailConfig();
            Mail::send('emails._customerForgotPassword', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });
    
            return response()->json(['error'=>['We have e-mailed your password reset link!'], 'status' => '0']);

        } else {
            return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);

        }
       
    }

    public function showResetPasswordForm(Request $request, $companyCode, $token) {
        $result = LandingPages::where('is_default_landing_page', 1)->first();
        $check = DB::table('customer_password_resets')->where('token', $token)->first();
        if( isset( $check ) && !empty( $check ))
        {
            if (!$result) {
                $result   = LandingPages::latest()->first();
            }
            $not_home   = 'auth';
            $page_type  = 'link';
            $email      = $check->email;
            return view('front.auth.login', compact('result', 'not_home', 'page_type', 'email'));
        } else {
            abort(419);
        }
        
    }

    public function resetPassword(Request $request ) 
    {

        $validator   = [
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required', 'min:8'],
        ];
        //Validate the product
        $validator                     = Validator::make( $request->all(), $validator );
        
        if ($validator->passes()) {

            $password = Hash::make($request->password);
            $info = Customer::where('email', $request->email)->first();
            $info->password = $password;
            $info->update();

            DB::table('customer_password_resets')->where('email', $request->email)->delete();
            
            return response()->json(['error'=>['Password reset successfully, Please try login'], 'status' => '0']);
        } else {
            return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
        }

    }
}