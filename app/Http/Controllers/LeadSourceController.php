<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\LeadSource;

class LeadSourceController extends Controller
{
    public function index(Request $request)
    {
        $params = array('btn_name' => 'Lead Soure', 'btn_fn_param' => 'leadsource');

        if ( $request->ajax()) {
            return view('crm.leadsource.index', $params);
            echo $view;
            die;
            echo json_encode(['view' => $view]);
            return true;
        } else {
            return view('crm.leadsource.index-load', $params);
        }
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'source', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = LeadSource::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = LeadSource::skip($start)->take($limit)->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = LeadSource::skip($start)->take($limit)->Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = LeadSource::count();
        } else {
            $total_filtered = LeadSource::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $leadsource ) {
                $leadsource_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'leadsource\','.$leadsource->id.', 1)"> Inactive </div>';
                if( $leadsource->status == 1 ) {
                    $leadsource_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'leadsource\','.$leadsource->id.', 0)"> Active </div>';
                }
                $action = '
                <a href="javascript:void(0);" class="action-icon" onclick="return view_modal(\'leadsource\', '.$leadsource->id.')"> <i class="mdi mdi-eye"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'leadsource\', '.$leadsource->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'leadsource\', '.$leadsource->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$leadsource->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'source' ]              = $leadsource->source;
                $nested_data[ 'status' ]            = $leadsource_status;
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

    public function add_edit(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Add Lead Source';
        if( isset( $id ) && !empty($id) ) {
            $info = LeadSource::find($id);
            $modal_title = 'Update Lead Source';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.leadsource.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

    public function view(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Lead Source Info';
        $info = LeadSource::find($id);
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.leadsource.view', $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        if( isset( $id ) && !empty($id) ) {
            $role_validator   = [
                'source'      => [ 'required', 'string', 'max:255', 'unique:lead_sources,source,'.$id ],
            ];
        } else {
            $role_validator   = [
                'source'      => [ 'required', 'string', 'max:255', 'unique:lead_sources,source'],
            ];
        }
        
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {

            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['source'] = $request->source;
            $ins['description'] = $request->description;
            
            if( isset($id) && !empty($id) ) {
                $lead = LeadSource::find($id);
                $lead->status = isset($request->status) ? 1 : 0;
                $lead->source = $request->source;
                $lead->description = $request->description;
                $lead->update();
                $success = 'Updated Lead Source';

            } else {
                $ins['added_by'] = Auth::id();
                LeadSource::create($ins);
                $success = 'Added new Lead Source';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = LeadSource::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $ins['status'] = $status;
        $lead = LeadSource::find($id);
        $lead->status = $status;
        $lead->update();
        $update_msg = 'Updated successfully';
        return response()->json(['error'=>[$update_msg], 'status' => '0']);
    }
}
