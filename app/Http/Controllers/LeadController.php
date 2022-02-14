<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Lead;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $params = array('btn_name' => 'Lead Soure', 'btn_fn_param' => 'leadsource');
        return view('crm.lead.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'lead_title', 'lead_type_id', 'lead_source_id', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = lead::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = lead::orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = lead::Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = lead::count();
        } else {
            $total_filtered = lead::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $leads ) {
                $leads_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'leads\','.$leads->id.', 1)"> Inactive </div>';
                if( $leads->status == 1 ) {
                    $leads_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'leads\','.$leads->id.', 0)"> Active </div>';
                }
                $action = '<a href="'.route('leads.view',['id' => $leads->id]).'" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'leads\', '.$leads->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$leads->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'title' ]             = $leads->lead_title ?? $leads->lead_subject;
                $nested_data[ 'type' ]              = $leads->leadType->type ?? 'N/A';
                $nested_data[ 'source' ]            = $leads->leadSource->source ?? 'N/A';
                $nested_data[ 'created_at' ]        = date('d-m-Y', strtotime($leads->created_at ) );
                $nested_data[ 'status' ]            = $leads_status;
                $nested_data[ 'action' ]            = $action;
                $data[]                             = $nested_data;
            }
        }

        return response()->json( [ 
            'draw'              => intval( $request->input( 'draw' ) ),
            'recordsTotal'      => intval( $total_list ),
            'data'              => $data,
            'recordsFiltered'   => intval( $total_filtered )
        ] );

    }

    public function view(Request $request, $id = '') {
        dd($id);
    }
}
