<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySettings;

class LandingController extends Controller
{
    public function index()
    {
        $info = CompanySettings::find(1);
        $params['info'] = $info;
        return view('landing.landing', $params);
    }
}
