<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use DB;
use App\Models\Status;

class ActivityStatusController extends Controller
{
    public function index(Request $request)
    {
        $urls_name = $request->segment(2);
        $urls = explode("-", $urls_name);
        $status_type = current($urls);
        
        $params = array('type' => $status_type, 'btn_name' => ucwords( str_replace("-", " ", $urls_name) ), 'btn_fn_param' => $urls_name);
        return view('crm.status.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $urls_name = $request->segment(2);
        $urls = explode("-", $urls_name);
        $status_type = current($urls);

        $columns            = [ 'id', 'status_name', 'is_active', 'id' ];
        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
        $approve_status     = $request->input( 'approve_status' );
       
        $total_list         = Status::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list           = Status::skip($start)->take($limit)->orderBy($order, $dir)
                                ->search( $search )->where('type', $status_type)
                                ->get();
        } else {
            $list           = Status::skip($start)->take($limit)->Latests()
                                ->search( $search )->where('type', $status_type)
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Status::where('type', $status_type)->count();
        } else {
            $total_filtered = Status::search( $search )->where('type', $status_type)
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $roles ) {

                $all_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\''.$roles->type.'-status\','.$roles->id.', 1)"> Inactive </div>';
                if( $roles->is_active == '1' ) {
                    $all_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\''.$roles->type.'-status\','.$roles->id.', 0)"> Active </div>';
                }
                
                $action                             = '
                <a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\''.$roles->type.'-status\', '.$roles->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\''.$roles->type.'-status\', '.$roles->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$roles->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'status_name' ]       = $roles->status_name;
                $nested_data[ 'order' ]             = $roles->order;
                $nested_data[ 'color' ]             = '<div style="background:'.$roles->color.';padding: 10px;width: 22px;border-radius: 3px;"></div>';
                $nested_data[ 'status' ]            = $all_status;
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
        $urls_name = $request->segment(2);
        $urls = explode("-", $urls_name);
        $status_type = current($urls);

        $id = $request->id;
        $urls_name = $request->segment(2);
        $modal_title = 'Add '.ucwords(str_replace('-', " ", $urls_name));
        if( isset( $id ) && !empty($id) ) {
            $info = Status::find($id);
            $modal_title = 'Update '.ucwords(str_replace('-', " ", $urls_name));
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'type' => $status_type];
        return view('crm.status.add_edit', $params);
        
    }

    public function save(Request $request)
    {
        $id = $request->id;
        $status_validator   = [
            'status_name'      => [ 'required', 'string', 'max:255', Rule::unique('status')->where(function($query) use ($request, $id) {
                return $query->where('type', $request->type)->when($id != '',function($q) use($id){
                    return $q->where('id', '!=', $id);
                });
            }) ],
        ];
        //Validate the product
        $validator          = Validator::make( $request->all(), $status_validator );
        
        if ( $validator->passes() ) {

            $ins['is_active'] = isset($request->is_active) ? 1 : 0;
            $ins['status_name'] = $request->status_name;
            $ins['order'] = $request->order;
            $ins['color'] = $request->color;
            $ins['type'] = $request->type;
            if( isset($id) && !empty($id) ) {
                $role = Status::find($id);
                $role->is_active = isset($request->is_active) ? 1 : 0;
                $role->status_name = $request->status_name;
                $role->order = $request->order;
                $role->color = $request->color;
                $role->type = $request->type;
                $role->update();
                $success = 'Updated';
            } else {
                Status::create($ins);
                $success = 'Added';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Status::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $deal = Status::find($id);
        $deal->is_active = $status;
        $deal->update();
        $update_msg = 'Updated successfully';
        $status = '0';
        
        return response()->json(['error'=>$update_msg, 'status' => $status]);
    }
}
