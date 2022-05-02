<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Payment;
use App\Models\Deal;
use App\Exports\ExportDealStarted;
use App\Exports\ExportSale;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportController extends Controller
{
    public function index(Request $request) {

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

    public function deal_started_pdf_download(Type $var = null)
    {
        if( isset($this->year) && !empty($this->year)) {
            $dates = explode("-", $this->year);
            $start_date = date('Y-m-d', strtotime($dates[0]));
            $end_date = date('Y-m-d', strtotime($dates[1]));

            $deals = Deal::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->get();
        } else {
            $deals = Deal::all();
        }
        $pdf = PDF::loadView('crm.exports.started_pdf', ['deals' => $deals]);
        
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

    public function deal_sales_pdf_download(Type $var = null)
    {
        if( isset($this->year) && !empty($this->year)) {
            $dates = explode("-", $this->year);
            $start_date = date('Y-m-d', strtotime($dates[0]));
            $end_date = date('Y-m-d', strtotime($dates[1]));

            $deals = Payment::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->get();
        } else {
            $deals = Payment::all();
        }
        $pdf = PDF::loadView('crm.exports.sales_pdf', ['deals' => $deals])->setPaper('a4', 'landscape');;
        
        $path = public_path('pdf/');
        $fileName =  time().'.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);

        $pdf = public_path('pdf/'.$fileName);
        return response()->download($pdf);
    }
}
