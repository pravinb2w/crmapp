<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login_page()
    {
        return view('auth.login');
    }


    public function check_login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $companyCode = $request->segment(1);
        $companyInfo = DB::table('company_settings')->where(['site_code' => $companyCode, 'status' => 1])->first();

        if (Auth::attempt($credentials)) {
            //here check notification count and set in session  
            //check subsciption has time period
            if( $companyInfo->id == auth()->user()->company_id ) {
                $company_subscriptions = DB::table('company_subscriptions')->where('company_id', $companyInfo->id)->first();
                $today = date('Y-m-d');

                $end_date = date('Y-m-d', strtotime($company_subscriptions->endAt ?? $today));
                
                if( isset($company_subscriptions) && $today > $end_date  ){

                    Auth::logout();
                    return redirect()->route('login', $companyCode)->withErrors(['message' => 'Subscription has expired, Please contact Administrator']);
                    
                } else {

                    $noti_count = DB::table('notifications')->where('user_id', Auth::id())->count();
                    $request->session()->put('notification_count', $noti_count);
                    return redirect()->route('dashboard', $companyCode);

                }
            } else {

                Auth::logout();
                return redirect()->route('login', $companyCode)->withErrors(['message' => 'User does not exist on database']);

            }
            
            
        } else {
            return redirect()->route('login', $companyCode)->withErrors(['message' => 'Invalid Email address or Password']);
        }
    }

    public function logout(Request $request) {

        $companyCode = $request->segment(1);
        Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()->route('login', $companyCode);

    }

    
    

}
