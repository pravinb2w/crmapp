<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $info = CompanySettings::find(1);
        return view('dashboard.home');
    }

    public function dealsIndex()
    {
        return view('dashboard.deals');
    }
    public function dealsPipeline()
    {
        return view('dashboard.deals-pipeline');
    }
}
