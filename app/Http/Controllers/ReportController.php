<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Deal;
use App\Models\Activity;
use App\Models\Task;
use App\Exports\ExportDealStarted;
use App\Exports\ExportSale;
use App\Exports\ExportForecast;
use App\Exports\ExportPlanned;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DB;

class ReportController extends Controller
{

    public $companyCode;

    public function __construct(Request $request)
    {
        $this->companyCode = $request->segment(1);
    }

    public function deal_started(Request $request) {
        $params['title'] = 'Deals Started and Convertion Reports';
        return view('crm.reports._started', $params);
    }

    public function ajax_deal_started_list(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $date = $request->date;

        $columns            = [ 'deal_title', 'deal_value', 'current_stage_id', 'customer_id', 'assigned_to', 'created_at' , 'status', 'expected_completed_date' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
        $approve_status     = $request->input( 'approve_status' );

        if( isset($date) && !empty($date)) {
            $dates = explode("-", $date);
            $start_date = date('Y-m-d', strtotime($dates[0]));
            $end_date = date('Y-m-d', strtotime($dates[1]));
        }
       
        $total_list         = Deal::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            if( isset($start_date) && !empty($start_date)){
                $list               = Deal::skip($start)->take($limit)->Latests()
                                ->search( $search )->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)
                                ->get();
            } else {
                $list               = Deal::skip($start)->take($limit)->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
            }
            
        } else {
            
            if( isset($start_date) && !empty($start_date)){
                $list               = Deal::skip($start)->take($limit)->Latests()
                                ->search( $search )->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)
                                ->get();
            } else {
                $list               = Deal::skip($start)->take($limit)->Latests()
                ->search( $search )
                ->get(); 
            }
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Deal::count();
        } else {
            $total_filtered = Deal::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $deals ) {
              
                $nested_data[ 'deal_title' ]    = $deals->deal_title;
                $nested_data[ 'deal_value' ]    = $deals->deal_value;
                $nested_data[ 'current_stage' ] = $deals->current_stage->stages;
                $nested_data[ 'customer' ]      = $deals->customer->first_name ?? '';
                $nested_data[ 'assigned_to' ]   = $deals->assignedTo->name ?? '';
                $nested_data[ 'started_at' ]    = date('d-m-Y', strtotime($deals->created_at));
                $nested_data[ 'status' ]        = ($deals->status == 1 ) ? 'Active' : 'Inactive';
                $nested_data[ 'expected_completed_date' ] = date('d-m-Y', strtotime($deals->expected_completed_date));
                $data[]                         = $nested_data;
            }
        }

        return response()->json( [ 
            'draw'              => intval( $request->input( 'draw' ) ),
            'recordsTotal'      => intval( $total_list ),
            'data'              => $data,
            'recordsFiltered'   => intval( $total_filtered )
        ] );

    }

    public function deal_started_download(Request $request)
    {
        ob_end_clean(); // this
        ob_start();
        return Excel::download(new ExportDealStarted($request->date), 'dealstarted.xlsx');
    }

    public function deal_started_pdf_download(Request $request)
    {
        if( isset($request->date) && !empty($request->date)) {
            $dates = explode("-", $request->date);
            $start_date = date('Y-m-d', strtotime($dates[0]));
            $end_date = date('Y-m-d', strtotime($dates[1]));

            $deals = Deal::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->get();
        } else {
            $deals = Deal::all();
        }
        $pdf = PDF::loadView('crm.exports.started_pdf', ['deals' => $deals, 'companyCode' => $this->companyCode]);
        
        $path = public_path('pdf/');
        $fileName =  time().'.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);

        $pdf = public_path('pdf/'.$fileName);
        return response()->download($pdf);
        return $pdf->download('deal_started_'.date('his').'.pdf');
    }
    // sales report function starts here
    public function sales(Request $request) {
        $params['title'] = 'Sales';
        return view('crm.reports.sales', $params);
    }

    public function ajax_deal_sales_list(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $date = $request->date;

        $columns            = [ 'created_at', 'payment_mode', 'customer_id', 'deal_id', 'order_id', 'currency' , 'amount', 'payment_method', 'cheque_no', 'cheque_date', 'reference_no', 'payment_status', 'description' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
        $approve_status     = $request->input( 'approve_status' );

        if( isset($date) && !empty($date)) {
            $dates = explode("-", $date);
            $start_date = date('Y-m-d', strtotime($dates[0]));
            $end_date = date('Y-m-d', strtotime($dates[1]));
        }
       
        $total_list         = Payment::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            if( isset($start_date) && !empty($start_date)){
                $list               = Payment::skip($start)->take($limit)->Latests()
                                ->search( $search )->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)
                                ->get();
            } else {
                $list               = Payment::skip($start)->take($limit)->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
            }
            
        } else {
            
            if( isset($start_date) && !empty($start_date)){
                $list               = Payment::skip($start)->take($limit)->Latests()
                                ->search( $search )->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)
                                ->get();
            } else {
                $list               = Payment::skip($start)->take($limit)->Latests()
                ->search( $search )
                ->get(); 
            }
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Payment::count();
        } else {
            $total_filtered = Payment::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $pay ) {

                $nested_data[ 'payment_date' ]  = date('d-m-Y', strtotime($pay->created_at));
                $nested_data[ 'payment_mode' ]  = ucwords($pay->payment_mode);
                $nested_data[ 'customer' ]      = $pay->customer->first_name ?? '';
                $nested_data[ 'deal' ]          = '';
                $nested_data[ 'order_id' ]      = $pay->order_id ?? '';
                $nested_data[ 'currency' ]      = $pay->currency ?? '';
                $nested_data[ 'amount' ]        = $pay->amount ?? '';
                $nested_data[ 'payment_method' ] = ucfirst($pay->payment_method);
                $nested_data['cheque_no'] = $pay->cheque_no ?? '';
                $nested_data['cheque_date'] = $pay->cheque_date ?? '';
                $nested_data['reference_no'] = $pay->reference_no ?? '';
                $nested_data['status'] = ucfirst($pay->payment_status);
                $nested_data['description'] = $pay->description ?? '';
                $data[]                         = $nested_data;
            }
        }

        return response()->json( [ 
            'draw'              => intval( $request->input( 'draw' ) ),
            'recordsTotal'      => intval( $total_list ),
            'data'              => $data,
            'recordsFiltered'   => intval( $total_filtered )
        ] );
    }

    public function deal_sales_download(Request $request)
    {
        ob_end_clean(); // this
        ob_start();
        return Excel::download(new ExportSale($request->date), 'sales.xlsx');
    }

    public function deal_sales_pdf_download(Request $request)
    {
        if( isset($request->date) && !empty($request->date)) {
            $dates = explode("-", $request->date);
            $start_date = date('Y-m-d', strtotime($dates[0]));
            $end_date = date('Y-m-d', strtotime($dates[1]));

            $deals = Payment::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->get();
        } else {
            $deals = Payment::all();
        }
        $pdf = PDF::loadView('crm.exports.sales_pdf', ['deals' => $deals,'companyCode' => $this->companyCode])->setPaper('a4', 'landscape');;
        
        $path = public_path('pdf/');
        $fileName =  time().'.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);

        $pdf = public_path('pdf/'.$fileName);
        return response()->download($pdf);
    }

    public function forecast(Request $request) {
        $params['title'] = 'Revenue Forecast Reports';
        return view('crm.reports.forecast', $params);
    }

    public function ajax_forecast_list(Request $request ){
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $date = $request->date;

        $columns            = [ 'deal_id', 'invoice_no', 'customer_id', 'due_date', 'currency' , 'amount' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );

        if( isset($date) && !empty($date)) {
            $dates = explode("-", $date);
            $start_date = date('Y-m-d', strtotime($dates[0]));
            $end_date = date('Y-m-d', strtotime($dates[1]));
        } else {
            $start_date = date('Y-m-1');
            $end_date = date('Y-m-t');
        }
       
        $total_list             = Invoice::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            if( isset($start_date) && !empty($start_date)){
                $list           = Invoice::skip($start)->take($limit)->Latests()
                                ->search( $search )->whereDate('due_date', '>=', $start_date)->whereDate('due_date', '<=', $end_date)
                                ->get();
            } 
            
        } else {
            
            if( isset($start_date) && !empty($start_date)) {
                $list           = Invoice::skip($start)->take($limit)->Latests()
                                ->search( $search )->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)
                                ->get();
            }

        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Invoice::count();
        } else {
            $total_filtered = Invoice::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $inv ) {

                $nested_data[ 'deal' ]          = $inv->deal->deal_title ?? '';
                $nested_data[ 'invoice' ]       = $inv->invoice_no ?? '';
                $nested_data[ 'customer' ]      = $inv->customer->first_name ?? '';
                $nested_data[ 'due_date' ]      = $inv->due_date ?? '';
                $nested_data[ 'amount' ]        = $inv->total ?? '';
            
                $data[]                         = $nested_data;
            }
        }

        return response()->json( [ 
            'draw'              => intval( $request->input( 'draw' ) ),
            'recordsTotal'      => intval( $total_list ),
            'data'              => $data,
            'recordsFiltered'   => intval( $total_filtered )
        ] );
    }

    public function forecast_download(Request $request) {
        // dd($request);
        ob_end_clean(); // this
        ob_start();
        return Excel::download(new ExportForecast($request->date), 'revenue_forecast.xlsx');
    }

    public function forecast_pdf_download (Request $request) {
        if( isset($request->date) && !empty($request->date)) {
            $dates = explode("-", $request->date);
            $start_date = date('Y-m-d', strtotime($dates[0]));
            $end_date = date('Y-m-d', strtotime($dates[1]));
        } else {
            $start_date = date('Y-m-1');
            $end_date = date('Y-m-t');
        }

        $fore = Invoice::whereDate('due_date', '>=', $start_date)->whereDate('due_date', '<=', $end_date)->get();
        
        $pdf = PDF::loadView('crm.exports.forecast_pdf', ['fore' => $fore, 'companyCode' => $this->companyCode])->setPaper('a4', 'portrait');;
        
        $path = public_path('pdf/');
        $fileName =  time().'.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);

        $pdf = public_path('pdf/'.$fileName);
        return response()->download($pdf);  
    } 

    public function planned_done(Request $request) {
        $params['title'] = 'Activities Planned and Done Reports';
        return view('crm.reports.planned', $params);
    }

    public function ajax_planned_list(Request $request ){
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $date = $request->date;
        $task_type = $request->task_type;
        $planned_done = $request->planned_done;

        $columns            = [ 'deal_id', 'invoice_no', 'customer_id', 'due_date', 'currency' , 'amount' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
        $start_date = '';
        $end_date = '';
        $dates = false;
        if( isset($date) && !empty($date)) {
            $dates = explode("-", $date);
            $start_date = date('Y-m-d', strtotime($dates[0]));
            $end_date = date('Y-m-d', strtotime($dates[1]));
            $dates =true;
        } 
       
        $total_list             = Activity::count();
        // DB::enableQueryLog();
        if( isset( $task_type ) && $task_type == 'activity') {
           
            $act           = Activity::skip($start)->take($limit)->Latests()
                            ->when($planned_done == 'planned', function($query){
                                return $query->where('status', 1);
                            })->when($planned_done == 'done', function($query){
                                return $query->where('status', 2);
                            })
                            ->when(isset($start_date) && !empty($start_date), function($query) use($start_date, $end_date){
                                return $query->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
                            })
                            ->search( $search )
                            ->get();

            if( empty( $request->input( 'search.value' ) ) ) {
                $total_filtered = Activity::count();
            } else {
                $total_filtered = Activity::search( $search )
                                    ->count();
            }
        } elseif( isset($task_type ) && $task_type == 'task' ) {
            $tlist           = Task::skip($start)->take($limit)->Latests()
                            ->when($planned_done == 'planned', function($query){
                                return $query->where('status', 1);
                            })->when($planned_done == 'done', function($query){
                                return $query->where('status', 2);
                            })
                            ->when(isset($start_date) && !empty($start_date), function($query) use($start_date, $end_date){
                                return $query->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
                            })
                            ->search( $search )
                            ->get();            

            if( empty( $request->input( 'search.value' ) ) ) {
                $total_filtered = Task::count();
            } else {
                $total_filtered = Task::search( $search )
                                    ->count();
            }
        } else {
            // DB::enableQueryLog();

            $tlist           = Task::skip($start)->take($limit)->Latests()
                            ->when($planned_done == 'planned', function($query){
                                return $query->where('status', 1);
                            })->when($planned_done == 'done', function($query){
                                return $query->where('status', 2);
                            })
                            ->when(isset($start_date) && !empty($start_date), function($query) use($start_date, $end_date){
                                return $query->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
                            })
                            ->search( $search )
                            ->get(); 
            // dd(DB::getQueryLog());

           
            $act           = Activity::skip($start)->take($limit)->Latests()
                            ->when($planned_done == 'planned', function($query){
                                return $query->where('status', 1);
                            })->when($planned_done == 'done', function($query){
                                return $query->where('status', 2);
                            })
                            ->when(isset($start_date) && !empty($start_date), function($query) use($start_date, $end_date){
                                return $query->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
                            })
                            ->search( $search )
                                ->get();

            if( empty( $request->input( 'search.value' ) ) ) {
                $total_filtered = count($act) + count($tlist);
            } else {
                $total_filtered = Task::search( $search )->count() + Activity::search($search)->count();
            }
        }
        $list = [];
        if( isset($tlist) && !empty($tlist) ) {
            foreach ($tlist as $item) {
                $tmp['title'] = $item->task_name;
                $tmp['type'] = 'Task';
                $tmp['customer'] = 'N/A';
                $tmp['user'] = $item->assigned->name ?? '';
                $tmp['lead_deal'] = 'N/A';
                $tmp['assigned_date'] = $item->created_at;
                $tmp['status'] = (isset($item->status) && $item->status == 1 ) ? 'Not Completed' : 'Completed';

                $list[] = $tmp;
            }
        }

        if( isset($act) && !empty($act) ) {
            $ntmp = [];
            foreach ($act as $item) {
                $ntmp['title'] = $item->subject;
                $ntmp['type'] = 'Activity';
                $ntmp['customer'] = $item->customer->first_name ?? '';
                $ntmp['user'] = $item->user->name ?? '';
                $ntmp['lead_deal'] = $item->lead->lead_subject ?? $item->deal->deal_title ?? '';
                $ntmp['assigned_date'] = $item->created_at;
                $ntmp['status'] = (isset($item->status) && $item->status == 1 ) ? 'Not Completed' : 'Completed';
                $list[] = $ntmp;

            }
        }
        foreach ($list as $key => $part) {
            $sort[$key] = strtotime($part['assigned_date']);
        }
        if( !empty($list)) {
            array_multisort($sort, SORT_DESC, $list);
        }
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $inv ) {

                $nested_data['title'] = $inv['title'];
                $nested_data['type'] = $inv['type'];
                $nested_data['customer'] = $inv['customer'];
                $nested_data['user'] = $inv['user'];
                $nested_data['lead_deal'] = $inv['lead_deal'];
                $nested_data['assigned_date'] = $inv['assigned_date'];
                $nested_data['status'] = $inv['status'];
            
                $data[]                         = $nested_data;
            }
        }
        return response()->json( [ 
            'draw'              => intval( $request->input( 'draw' ) ),
            'recordsTotal'      => intval( $total_filtered ),
            'data'              => $data,
            'recordsFiltered'   => intval( $total_filtered )
        ] );
    }

    public function planned_download(Request $request) {
        // dd($request);
        ob_end_clean(); // this
        ob_start();
        return Excel::download(new ExportPlanned($request->date, $request->task_type, $request->planned_done), 'planned.xlsx');
    }

    public function planned_pdf_download (Request $request) {
        $start_date = '';
        $end_date = '';
        if( isset($request->date) && !empty($request->date)) {
            $dates = explode("-", $request->date);
            $start_date = date('Y-m-d', strtotime($dates[0]));
            $end_date = date('Y-m-d', strtotime($dates[1]));
            $dates =true;
        } 
       
        $total_list             = Activity::count();
        // DB::enableQueryLog();
        if( isset( $request->type ) && $request->type == 'activity') {
           
            $act           = Activity::Latests()
                            ->when($request->status == 'planned', function($query){
                                return $query->where('status', 1);
                            })->when($request->status == 'done', function($query){
                                return $query->where('status', 2);
                            })
                            ->when(isset($start_date) && !empty($start_date), function($query) use($start_date, $end_date){
                                return $query->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
                            })
                            ->get();

            
        } elseif( isset($request->type ) && $request->type == 'task' ) {
            $tlist           = Task::Latests()
                            ->when($request->status == 'planned', function($query){
                                return $query->where('status', 1);
                            })->when($request->status == 'done', function($query){
                                return $query->where('status', 2);
                            })
                            ->when(isset($start_date) && !empty($start_date), function($query) use($start_date, $end_date){
                                return $query->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
                            })
                            ->get();            

          
        } else {
            // DB::enableQueryLog();

            $tlist           = Task::Latests()
                            ->when($request->status == 'planned', function($query){
                                return $query->where('status', 1);
                            })->when($request->status == 'done', function($query){
                                return $query->where('status', 2);
                            })
                            ->when(isset($start_date) && !empty($start_date), function($query) use($start_date, $end_date){
                                return $query->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
                            })
                            ->get(); 
            // dd(DB::getQueryLog());

           
            $act           = Activity::Latests()
                            ->when($request->status == 'planned', function($query){
                                return $query->where('status', 1);
                            })->when($request->status == 'done', function($query){
                                return $query->where('status', 2);
                            })
                            ->when(isset($start_date) && !empty($start_date), function($query) use($start_date, $end_date){
                                return $query->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
                            })
                            ->get();

            
        }
        $list = [];
        if( isset($tlist) && !empty($tlist) ) {
            foreach ($tlist as $item) {
                $tmp['title'] = $item->task_name;
                $tmp['type'] = 'Task';
                $tmp['customer'] = 'N/A';
                $tmp['user'] = $item->assigned->name ?? '';
                $tmp['lead_deal'] = 'N/A';
                $tmp['assigned_date'] = $item->created_at;
                $tmp['status'] = (isset($item->status) && $item->status == 1 ) ? 'Not Completed' : 'Completed';

                $list[] = $tmp;
            }
        }

        if( isset($act) && !empty($act) ) {
            $ntmp = [];
            foreach ($act as $item) {
                $ntmp['title'] = $item->subject;
                $ntmp['type'] = 'Activity';
                $ntmp['customer'] = $item->customer->first_name ?? '';
                $ntmp['user'] = $item->user->name ?? '';
                $ntmp['lead_deal'] = $item->lead->lead_subject ?? $item->deal->deal_title ?? '';
                $ntmp['assigned_date'] = $item->created_at;
                $ntmp['status'] = (isset($item->status) && $item->status == 1 ) ? 'Not Completed' : 'Completed';
                $list[] = $ntmp;

            }
        }
        foreach ($list as $key => $part) {
            $sort[$key] = strtotime($part['assigned_date']);
        }
        if( !empty($list)) {
            array_multisort($sort, SORT_DESC, $list);
        }
        
        $pdf = PDF::loadView('crm.exports.planned_pdf', ['list' => $list, 'companyCode' => $this->companyCode])->setPaper('a4', 'portrait');;
        
        $path = public_path('pdf/');
        $fileName =  time().'.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);

        $pdf = public_path('pdf/'.$fileName);
        return response()->download($pdf);  
    } 
}
