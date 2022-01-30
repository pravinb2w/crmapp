<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Users', 'btn_fn_param' => 'users');
        return view('crm.user.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'role', 'added_by', 'status', '' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
        $approve_status     = $request->input( 'approve_status' );
       
        $total_list         = Role::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = Role::orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = Role::Latests()
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
                $action = '<a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
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

    
}
