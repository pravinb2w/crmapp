<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Country;

class CountryController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Country', 'btn_fn_param' => 'country');
        return view('crm.country.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'country_name', 'dial_code', 'country_code', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = Country::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = Country::skip($start)->take($limit)->whereRaw('created_at')->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = Country::skip($start)->take($limit)->whereRaw('created_at')->Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Country::count();
        } else {
            $total_filtered = Country::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $county ) {
                $county_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'country\','.$county->id.', 1)"> Inactive </div>';
                if( $county->status == 1 ) {
                    $county_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'country\','.$county->id.', 0)"> Active </div>';
                }
                $action = '
                <a href="javascript:void(0);" class="action-icon" onclick="return view_modal(\'country\', '.$county->id.')"> <i class="mdi mdi-eye"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'country\', '.$county->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'country\', '.$county->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$county->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'country_name' ]      = $county->country_name;
                $nested_data[ 'dial_code' ]         = $county->dial_code ?? '-';
                $nested_data[ 'country_code' ]      = $county->country_code ?? '-';
                $nested_data[ 'currency' ]          = $county->currency ?? '-';
                $nested_data[ 'status' ]            = $county_status;
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
        $modal_title = 'Add Country';
        if( isset( $id ) && !empty($id) ) {
            $info = Country::find($id);
            $modal_title = 'Update Country';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.country.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

    public function view(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Country Info';
        $info = Country::find($id);
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.country.view', $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        
        if( isset( $id ) && !empty($id) ) {
            $role_validator   = [
                'country_name'      => [ 'required', 'string', 'max:255', 'unique:countries,country_name,'.$id ],
            ];
        } else {
            $role_validator   = [
                'country_name'      => [ 'required', 'string', 'max:255', 'unique:countries,country_name'],
            ];
        }
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {

            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['country_name'] = $request->country_name;
            $ins['dial_code'] = $request->dial_code;
            $ins['country_code'] = $request->country_code;
            $ins['currency'] = $request->currency;
            $ins['description'] = $request->description;
            
            if( isset($id) && !empty($id) ) {
                $count = Country::find($id);
                $count->status = isset($request->status) ? 1 : 0;
                $count->country_name = $request->country_name;
                $count->dial_code = $request->dial_code;
                $count->country_code = $request->country_code;
                $count->currency = $request->currency;
                $count->description = $request->description;
                $count->update();

                $success = 'Updated country';
            } else {
                $ins['added_by'] = Auth::id();
                Country::create($ins);
                $success = 'Added new country';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Country::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $role = Country::find($id);
        $role->status = $status;
        $role->update();
        $update_msg = 'Updated successfully';
        return response()->json(['error'=>[$update_msg], 'status' => '0']);
    }
}
