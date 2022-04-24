<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DealStage;
use App\Models\DashboardOrder;
use App\Models\Task;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;
use App\Models\Deal;
use App\Models\User;

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
        $today = date('Y-m-d');
        $orders = DashboardOrder::all();
        //get open task
        $task = Task::where('status', 1)->count();
        $lead = Lead::where('status', 1)->count();
        $deal = Deal::where('status', 1)->count();
        $open_task = $task ?? 0 + $lead ?? 0 + $deal ?? 0;
        //get today task
        $today_task = Task::where('status', 1)->whereDate('created_at', '=', $today )->count();
        $today_lead = Lead::where('status', 1)->whereDate('created_at', '=', $today )->count();
        $today_deal = Deal::where('status', 1)->whereDate('created_at', '=', $today )->count();
        $today_count = $today_task ?? 0 + $today_lead ?? 0 + $today_deal ?? 0;
        //get closed task
        $closed_task = Task::where('status', 2)->count();
        $closed_lead = Lead::where('status', 2)->count();
        $closed_deal = Deal::where('status', 2)->count();
        $closed_count = ($closed_task ?? 0) + ($closed_lead ?? 0) + ($closed_deal ?? 0);
        //get planned task
        $planned_task = Task::count();
        $planned_lead = Lead::count();
        $planned_deal = Deal::count();
        
        $planned_count = ( $planned_task ?? 0 ) + ( $planned_lead ?? 0 ) + ( $planned_deal ?? 0 );
        //mytask
        $my_task = $this->my_task();
        //all task
        // $all_task = $this->all_task();

        //close of the week
        $close_week = $this->close_week();
        $planned_done = $this->get_done_planed();
        $conversion = $this->get_deal_conversion();
        $overall_collection = $this->overall_collection();

        
        $params['open_task']        =   $open_task;
        $params['today_count']      =   $today_count;
        $params['planned_count']    =   $planned_count;
        $params['closed_count']     =   $closed_count;
        $params['my_task']          =   $my_task;
        $params['close_week']       =   $close_week;
        $params['planned_done']     =   $planned_done;
        $params['conversion']       =   $conversion;
        $params['overall_collection'] = $overall_collection;
        
        $user_dashboard     =   User::find(auth()->user()->id);
        $starting_order     =   [["sortable-1","sortable-2","sortable-3","sortable-4","sortable-5","sortable-6","sortable-7","sortable-8","sortable-9"],["col-6","col-6","col-6","col-6","col-6","col-6","col-6","col-6","col-6"]];
        
        $sortable           =   json_decode($user_dashboard->sorting_order) ?? $starting_order;

        return view('dashboard.home', $params , compact('sortable'));
    }

    public function save_dashboard_position(Request $request)
    {
        $sortable   =  User::find(auth()->user()->id);
        $sortable->sorting_order = json_encode($request->data);
        $sortable->save();
        return json_decode($sortable->sorting_order);
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

    public function my_task() {

        $role_id = auth()->user()->role_id;
        if( $role_id ) {
            $my_task = Task::where('status', 1)->where('assigned_to', Auth::id() )->get();
            $my_lead = Lead::where('status', 1)->where('assigned_to', Auth::id() )->get();
            $my_deal = Deal::where('status', 1)->where('assigned_to', Auth::id() )->get();
        } else {
            $my_task = Task::where('status', 1)->get();
            $my_lead = Lead::where('status', 1)->get();
            $my_deal = Deal::where('status', 1)->get();
        }
        
        $my_arr = [];
        if( isset( $my_task ) && !empty($my_task)){
            foreach ($my_task as $key => $value) {
                $tmp['task_type'] = 'task';
                $tmp['task_name'] = $value->task_name;
                $tmp['description'] = $value->description;
                $tmp['status'] = $value->status;
                $tmp['customer'] = '';
                $my_arr[] = $tmp;
            }
        }
        if( isset( $my_lead ) && !empty($my_lead)){
            foreach ($my_lead as $key => $value) {
                $tmp['task_type'] = 'lead';
                $tmp['task_name'] = $value->lead_subject;
                $tmp['description'] = $value->lead_description;
                $tmp['status'] = $value->status;
                $tmp['customer'] = $value->customer;
                $my_arr[] = $tmp;
            }
        }
        if( isset( $my_deal ) && !empty($my_deal)){
            foreach ($my_deal as $key => $value) {
                $tmp['task_type'] = 'deal';
                $tmp['task_name'] = $value->deal_title;
                $tmp['description'] = $value->deal_description;
                $tmp['status'] = $value->status;
                $tmp['customer'] = $value->customer;
                $my_arr[] = $tmp;
            }
        }

        return $my_arr;
    }

    public function close_week() {
        $data_type = $_POST['close_week_type'] ?? '';
        $months = lastYearByMonth();
        if( isset( $data_type ) && !empty($data_type ) ) {

        } else {
            $data_type = 'planned';
        }
        $task = [];
        $month = [];
        $deal = [];
        $lead = [];
        if( isset($months) && !empty($months)){
            foreach ($months as $key => $value) {
                $month[] = $key;
                $start_date = date('Y-m-d', strtotime($value));
                $end_date = date('Y-m-t', strtotime($value));
                if( $data_type == 'planned') {
                    $planned_task = Task::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                    $planned_lead = Lead::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                    $planned_deal = Deal::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                } else {
                    $planned_task = Task::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();
                    $planned_lead = Lead::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();
                    $planned_deal = Deal::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();
                }
                
                
                $task[] = $planned_task ?? 0;
                $deal[] = $planned_deal ?? 0;
                $lead[] = $planned_lead ?? 0;
            }
        }
        $arr = array('lead' => $lead, 'deal' => $deal, 'task' => $task, 'month' => $month );
        return $arr;
    }

    public function get_done_planed(){
        $data_from = $_POST['from_type'] ?? '';
        $months = lastYearByMonth();
        
        $planned = [];
        $month = [];
        $done = [];
        if( isset($months) && !empty($months)){
            foreach ($months as $key => $value) {
                $month[] = $key;
                $planed_total = 0;
                $done_total = 0;
                $start_date = date('Y-m-d', strtotime($value));
                $end_date = date('Y-m-t', strtotime($value));
                $planned_task = 0;
                $done_task = 0;
                $planned_lead = 0;
                $done_lead = 0;
                $planned_deal = 0;
                $done_deal = 0;
                if( $data_from == 'task') {
                    $planned_task = Task::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                    $done_task = Task::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();
                } else if( $data_from == 'lead') {
                    $planned_lead = Lead::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                    $done_lead = Lead::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();
                } else if( $data_from == 'deal') {
                    $planned_deal = Deal::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                    $done_deal = Deal::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();
                } else {
                    $planned_task = Task::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                    $done_task = Task::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();
                    $planned_lead = Lead::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                    $done_lead = Lead::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();
                    $planned_deal = Deal::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                    $done_deal = Deal::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();
                }
                $planed_total = $planned_task ?? 0 + $planned_lead ?? 0 + $planned_deal ?? 0;
                $done_total = $done_task ?? 0 + $done_lead ?? 0 + $done_deal ?? 0;
                
                $planned[] = $planed_total ?? 0;
                $done[] = $done_total ?? 0;
            }
        }
        $arr = array('planned' => $planned, 'done' => $done, 'month' => $month );
        return $arr;
    }

    public function ajax_get_done_planed(){
        $data_from = $_POST['from_type'] ?? '';
        $months = lastYearByMonth();
        $planned = [];
        $month = [];
        $done = [];
        if( isset($months) && !empty($months)){
            foreach ($months as $key => $value) {
                $month[] = $key;
                $planed_total = 0;
                $done_total = 0;
                $start_date = date('Y-m-d', strtotime($value));
                $end_date = date('Y-m-t', strtotime($value));
                $planned_task = 0;
                $done_task = 0;
                $planned_lead = 0;
                $done_lead = 0;
                $planned_deal = 0;
                $done_deal = 0;
                if( $data_from == 'task') {
                    $planned_task = Task::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                    $done_task = Task::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();
                } else if( $data_from == 'lead') {
                    $planned_lead = Lead::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                    $done_lead = Lead::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();
                } else if( $data_from == 'deal') {
                    $planned_deal = Deal::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                    $done_deal = Deal::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();
                } else {
                    $planned_task = Task::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                    $done_task = Task::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();
                    $planned_lead = Lead::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                    $done_lead = Lead::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();
                    $planned_deal = Deal::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                    $done_deal = Deal::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();
                }
                $planed_total = ($planned_task ?? 0) + ($planned_lead ?? 0) + ($planned_deal ?? 0);
                $done_total = ($done_task ?? 0) + ($done_lead ?? 0) + ($done_deal ?? 0);
                
                $planned[] = $planed_total ?? 0;
                $done[] = $done_total ?? 0;
            }
        }
        $arr = array('planned' => $planned, 'done' => $done, 'month' => $month );
        $params['planned_done'] = $arr;
        return view('dashboard._planned_done', $params );
    }
    
    public function get_deal_conversion() {
        $months = lastYearByMonth();
        $month = [];
        $conversion = [];
        $started = [];
        $won = [];
        if( isset($months) && !empty($months)){
            foreach ($months as $key => $value) {
                $month[] = $key;
                $start_date = date('Y-m-d', strtotime($value));
                $end_date = date('Y-m-t', strtotime($value));
                $convert = Deal::whereNotNull('lead_id')->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                $start = Deal::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
                $won_deal = Deal::whereDate('won_at', '>=', $start_date)->whereDate('won_at', '<=', $end_date)->count();
                $started[] = $start;
                $conversion[] = $convert;
                $won[] = $won_deal;
            }
        }
        $arr = array( 'month' => $month, 'conversion' => $conversion, 'started' => $started, 'won' => $won );
        return $arr;
    }

    public function overall_collection() {
        $year = date('Y');
        $start = $year.'-01-01';
        $start_date = date('Y-m-d', strtotime($start));

        $end = $year.'-12-01';
        $end_date = date('Y-m-t', strtotime($end));

        $deal = Deal::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
        $lead = Lead::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
        $task = Task::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();

        $arr = array( 'deal' => $deal, 'lead' => $lead, 'task' => $task );
        return $arr;

    }
}
