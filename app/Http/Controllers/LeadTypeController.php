<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\LeadType;

class LeadTypeController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Lead Type', 'btn_fn_param' => 'leadtype');
        return view('crm.leadtype.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'type', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = LeadType::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = LeadType::skip($start)->take($limit)->whereRaw('created_at')->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = LeadType::skip($start)->take($limit)->whereRaw('created_at')->Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = LeadType::count();
        } else {
            $total_filtered = LeadType::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $leadtype ) {
                $leadtype_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'leadtype\','.$leadtype->id.', 1)"> Inactive </div>';
                if( $leadtype->status == 1 ) {
                    $leadtype_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'leadtype\','.$leadtype->id.', 0)"> Active </div>';
                }
                $action = '
                <a href="javascript:void(0);" class="action-icon" onclick="return view_modal(\'leadtype\', '.$leadtype->id.')"> <i class="mdi mdi-eye"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'leadtype\', '.$leadtype->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'leadtype\', '.$leadtype->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$leadtype->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'type' ]              = $leadtype->type;
                $nested_data[ 'status' ]            = $leadtype_status;
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
        $modal_title = 'Add Lead Type';
        if( isset( $id ) && !empty($id) ) {
            $info = LeadType::find($id);
            $modal_title = 'Update Lead Type';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.leadtype.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

    public function view(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Lead Type Info';
        $info = LeadType::find($id);
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.leadtype.view', $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        
        if( isset( $id ) && !empty($id) ) {
            $role_validator   = [
                'type'      => [ 'required', 'string', 'max:255', 'unique:lead_types,type,'.$id ],
            ];
        } else {
            $role_validator   = [
                'type'      => [ 'required', 'string', 'max:255', 'unique:lead_types,type'],
            ];
        }
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {

            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['type'] = $request->type;
            $ins['description'] = $request->description;
            
            if( isset($id) && !empty($id) ) {
                $leadtype = LeadType::find($id);
                $leadtype->status = isset($request->status) ? 1 : 0;
                $leadtype->type = $request->type;
                $leadtype->description = $request->description;
                $leadtype->update();
                $success = 'Updated Lead Type';
            } else {
                $ins['added_by'] = Auth::id();
                LeadType::create($ins);
                $success = 'Added new Lead Type';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = LeadType::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $ins['status'] = $status;
        $leadtype = LeadType::find($id);
        $leadtype->status = $status;
        $leadtype->update();
        $update_msg = 'Updated successfully';
        return response()->json(['error'=>[$update_msg], 'status' => '0']);
    }
}
