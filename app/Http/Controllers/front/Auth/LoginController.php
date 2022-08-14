<?php

namespace App\Http\Controllers\front\Auth;

use App\Http\Controllers\Controller;
use App\Models\LandingPages;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function index(Request $request) {
        $result = LandingPages::where('is_default_landing_page', 1)->first();
    
        if (!$result) {
            $result   = LandingPages::latest()->first();
        }
        $not_home = 'auth';
        return view('front.auth.login', compact('result', 'not_home'));

    }

    public function validate_login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::guard('client')->attempt(['email' => $email, 'password' => $password])) {
            $details = Auth::guard('client')->user();
          
            return response()->json(['message' => 'Login success', 'status' => 1, 'url' => route('profile')]);
        } else {
            return response()->json(['message' => 'Invalid Email address or Password', 'status' => 0]);
        }
    }

    public function logout(Request $request) {
        Auth::guard('client')->logout();
        return redirect()->route('customer-login');
    }
}
