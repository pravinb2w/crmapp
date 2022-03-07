<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;

class RoleController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Roles', 'btn_fn_param' => 'roles');
        return view('crm.roles.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'role', 'added_by', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
        $approve_status     = $request->input( 'approve_status' );
       
        $total_list         = Role::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = Role::skip($start)->take($limit)->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = Role::skip($start)->take($limit)->Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Role::count();
        } else {
            $total_filtered = Role::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $roles ) {
                $roles_status                         = '<div class="badge bg-danger"> Inactive </div>';
                if( $roles->status == '1' ) {
                    $roles_status                     = '<div class="badge bg-success"> Active </div>';
                }
                $action = '
                <a href="javascript:void(0);" class="action-icon" onclick="return view_modal(\'roles\', '.$roles->id.')"> <i class="mdi mdi-eye"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'roles\', '.$roles->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'roles\', '.$roles->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$roles->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'role' ]              = $roles->role;
                $nested_data[ 'addedBy' ]           = $roles->added->name;
                $nested_data[ 'status' ]            = $roles_status;
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
        $modal_title = 'Add Roles';
        if( isset( $id ) && !empty($id) ) {
            $info = Role::find($id);
            $modal_title = 'Update Roles';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.roles.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

    public function view(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Role Info';
        $info = Role::find($id);
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.roles.view', $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        if( isset( $id ) && !empty($id) ) {
            $role_validator   = [
                'role'      => [ 'required', 'string', 'max:255', 'unique:roles,role,'.$id ],
            ];
        } else {
            $role_validator   = [
                'role'      => [ 'required', 'string', 'max:255', 'unique:roles,role' ],
            ];
        }
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {

            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['role'] = $request->role;
            $ins['description'] = $request->description;
            
            if( isset($id) && !empty($id) ) {
                $role = Role::find($id);
                $role->status = isset($request->status) ? 1 : 0;
                $role->role = $request->role;
                $role->description = $request->description;
                $role->update();
                $success = 'Updated role';
            } else {
                $ins['added_by'] = Auth::id();
                Role::create($ins);
                $success = 'Added new roles';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Role::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }
}
