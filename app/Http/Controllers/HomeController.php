<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DealStage;
use App\Models\DashboardOrder;

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
        $orders = DashboardOrder::all();
        $params = [];
        if( isset($orders) && !empty($orders)) {
            foreach ($orders as $key => $value) {
                $params[ $value->content ] = $value->position;
            }
        }
        return view('dashboard.home', $params);
    }

    public function dealsIndex()
    {
        return view('dashboard.deals');
    }
    public function dealsPipeline()
    {
        $stage = DealStage::orderBy('order_by', 'asc')->get();
        $params = ['stage' => $stage ];

        return view('dashboard.deals-pipeline', $params);
    }
}
