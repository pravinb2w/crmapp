<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;

class ActivityLogController extends Controller
{
    public function index()
    {
        $audits = \OwenIt\Auditing\Models\Audit::with('user')
                ->orderBy('created_at', 'desc') 
                ->limit(10)               
                ->get();
        $params = array('audit' => $audits);
        return view('crm.utilities.activity_log.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'task_name',  'assigned_to', 'created_at', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = Audit::count();
        // DB::enableQueryLog();
        
        if( $order != 'id') {
            $list               = Audit::with('user')->skip($start)->take($limit)->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = Audit::with('user')->skip($start)->take($limit)->Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Audit::count();
        } else {
            $total_filtered = Audit::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $audits ) {
                // $old = unserialize($audits->old_values);
                $old_values = '';
                $old_values = '<div>';
                foreach($audits->old_values as $attribute  => $value) {                            
                    $old_values = '<span>'.$attribute.':'.$value.'</span>';
                }
                $old_values .= '</div>';

                $new_values = '';
                $new_values = '<div>';
                foreach($audits->new_values as $attribute  => $value) {                            
                    $new_values = '<span>'.$attribute.':'.$value.'</span>';
                }
                $new_values .= '</div>';

                $action = '<a href="javascript:;" onclick="return get_log_view('.$audits->id.')"><i class="fa fa-eye"></i></a>';

                $nested_data[ 'log_date' ]      = date('d-m-Y H:i A', strtotime($audits->created_at ) );
                $nested_data[ 'logged_by' ]     = $audits->user->name;
                $nested_data[ 'operation' ]     = ucfirst($audits->event ?? '');
                $nested_data[ 'module' ]        = $audits->auditable_type;
                $nested_data[ 'old_values' ]    = $old_values;
                $nested_data[ 'new_values' ]    = $new_values;
                $nested_data['action']          = $action;
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

    public function view(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $log_id = $request->log_id;
        $modal_title = 'Log Info';
        $info = Audit::find($log_id);
        $params = ['modal_title' => $modal_title, 'info' => $info ?? ''];
        return view('crm.utilities.activity_log.view', $params);
    }

}
