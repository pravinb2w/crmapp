<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Permission;
use App\Models\Role;


class PermissionController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Permission', 'btn_fn_param' => 'permissions');
        return view('crm.permission.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'role', 'addedBy', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = Permission::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list           = Permission::whereRaw('created_at')->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list           = Permission::whereRaw('created_at')->Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Permission::count();
        } else {
            $total_filtered = Permission::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $permissions ) {
               
                $action = '<a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'permissions\', '.$permissions->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'permissions\', '.$permissions->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$permissions->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'page' ]              = $permissions->page;
                $nested_data['addedBy']             = '';
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
        $modal_title = 'Add Role Permissions';
        $role = Role::all();

        if( isset( $id ) && !empty($id) ) {
            $info = Permission::find($id);
            $modal_title = 'Update Role Permissions';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'role' => $role];
        return view('crm.permission.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }
}
