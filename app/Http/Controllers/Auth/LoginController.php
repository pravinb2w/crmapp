<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
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
       
        if (Auth::attempt($credentials)) {
            //here check notification count and set in session  
            //check subsciption has time period
            $company_subscriptions = \DB::table('company_subscriptions')->where('company_id', 1)->first();
            $end_date = date('Y-m-d', strtotime($company_subscriptions->endAt));
            $today = date('Y-m-d');
            
            if( isset($company_subscriptions) && $today > $end_date  ){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->withErrors(['message' => 'Subscription has expired, Please contact Adminitrator']);
                
            } else {
                $noti_count = \DB::table('notifications')->where('user_id', Auth::id())->count();
                $request->session()->put('notification_count', $noti_count);
                return redirect()->route('dashboard');
            }
            
        } else {
            return redirect('/devlogin')->withErrors(['message' => 'Invalid Email address or Password']);
        }
    }

    public function logout(Request $request) {
                
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');

    }

    
    

}
