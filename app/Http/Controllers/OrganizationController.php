<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;

class OrganizationController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Organization', 'btn_fn_param' => 'organizations');
        return view('crm.organization.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'name', 'email', 'mobile_no', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = Organization::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = Organization::orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = Organization::Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Organization::count();
        } else {
            $total_filtered = Organization::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $organizations ) {
                $organizations_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'organizations\','.$organizations->id.', 1)"> Inactive </div>';
                if( $organizations->status == 1 ) {
                    $organizations_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'organizations\','.$organizations->id.', 0)"> Active </div>';
                }
                $action = '<a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'organizations\', '.$organizations->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'organizations\', '.$organizations->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$organizations->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'name' ]              = $organizations->name;
                $nested_data[ 'email' ]             = $organizations->email;
                $nested_data[ 'mobile_no' ]         = $organizations->mobile_no;
                $nested_data[ 'status' ]            = $organizations_status;
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
        $modal_title = 'Add Organization';

        if( isset( $id ) && !empty($id) ) {
            $info = Organization::find($id);
            $modal_title = 'Update Organization';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.organization.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

    public function save(Request $request)
    {
        $id = $request->id;
        
        
        if( isset( $id ) && !empty($id) ) {
            $role_validator   = [
                'name'      => [ 'required', 'string', 'max:255', 'unique:organizations,name,'.$id ],
                'email'      => [ 'nullable', 'string', 'max:255', 'unique:organizations,email,'.$id ],
                'mobile_no'      => [ 'nullable', 'string', 'max:255', 'unique:organizations,mobile_no,'.$id ],

            ];
        } else {
            $role_validator   = [
                'name'      => [ 'required', 'string', 'max:255', 'unique:organizations,name'],
                'email'      => [ 'nullable', 'string', 'max:255', 'unique:organizations,email'],
                'mobile_no'      => [ 'nullable', 'string', 'max:255', 'unique:organizations,mobile_no'],

            ];
        }
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {

            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['name'] = $request->name;
            $ins['email'] = $request->email;
            $ins['mobile_no'] = $request->mobile_no;
            $ins['address'] = $request->address;
            
            if( isset($id) && !empty($id) ) {
                Organization::whereId($id)->update($ins);
                $success = 'Updated Organization';
            } else {
                $ins['added_by'] = Auth::id();
                Organization::create($ins);
                $success = 'Added new Organization';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Organization::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $ins['status'] = $status;
        Organization::whereId($id)->update($ins);
        $update_msg = 'Updated successfully';
        return response()->json(['error'=>[$update_msg], 'status' => '0']);
    }

}
