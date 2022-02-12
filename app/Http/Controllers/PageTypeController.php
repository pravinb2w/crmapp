<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\PageType;
use App\Models\CompanySettings;

class PageTypeController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Page Type', 'btn_fn_param' => 'pagetype');
        return view('crm.pagetype.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'page', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = PageType::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = PageType::whereRaw('created_at')->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = PageType::whereRaw('created_at')->Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = PageType::count();
        } else {
            $total_filtered = PageType::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $pagetype ) {
                $pagetype_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'pagetype\','.$pagetype->id.', 1)"> Inactive </div>';
                if( $pagetype->status == 1 ) {
                    $pagetype_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'pagetype\','.$pagetype->id.', 0)"> Active </div>';
                }
                $action = '<a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'pagetype\', '.$pagetype->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'pagetype\', '.$pagetype->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$pagetype->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'page' ]              = $pagetype->page;
                $nested_data[ 'status' ]            = $pagetype_status;
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
        $modal_title = 'Add Page Type';
        $company = CompanySettings::whereNotNull('created_at')->get();

        if( isset( $id ) && !empty($id) ) {
            $info = PageType::find($id);
            $modal_title = 'Update Page Type';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'company' => $company];
        return view('crm.pagetype.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

    public function save(Request $request)
    {
        $id = $request->id;
        
        $role_validator   = [
            'page'      => [ 'required', 'string', 'max:255'],
        ];
        if( isset( $id ) && !empty($id) ) {
            $role_validator   = [
                'page'      => [ 'required', 'string', 'max:255', 'unique:page_types,page,'.$id ],
            ];
        } else {
            $role_validator   = [
                'page'      => [ 'required', 'string', 'max:255', 'unique:page_types,page'],
            ];
        }
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {

            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['page'] = $request->page;
            $ins['description'] = $request->description;
            
            if( isset($id) && !empty($id) ) {
                $page = PageType::find($id);
                $page->status = isset($request->status) ? 1 : 0;
                $page->page = $request->page;
                $page->description = $request->description;
                $page->update();
                $success = 'Updated Page Type';
            } else {
                $ins['added_by'] = Auth::id();
                PageType::create($ins);
                $success = 'Added new Page Type';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = PageType::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $page = PageType::find($id);
        $page->status = $status;
        $page->update();
        $update_msg = 'Updated successfully';
        return response()->json(['error'=>[$update_msg], 'status' => '0']);
    }
}
