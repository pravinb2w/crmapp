<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\LandingPages;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request) {
        
        $result = LandingPages::where('is_default_landing_page', 1)->first();
    
        if (!$result) {
            $result   = LandingPages::latest()->first();
        }
        $not_home = 'yes';
        return view('front.customer.index', compact('result', 'not_home'));
    }
}
