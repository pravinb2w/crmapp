<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use CommonHelper;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Product', 'btn_fn_param' => 'products');
        return view('crm.products.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'product_name',  'product_code', 'added', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = Product::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = Product::whereRaw('created_at')->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = Product::whereRaw('created_at')->Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Product::count();
        } else {
            $total_filtered = Product::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $products ) {
                $products_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'products\','.$products->id.', 1)"> Inactive </div>';
                if( $products->status == 1 ) {
                    $products_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'products\','.$products->id.', 0)"> Active </div>';
                }
                $action = '<a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'products\', '.$products->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'products\', '.$products->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$products->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'product_name' ]      = $products->product_name;
                $nested_data[ 'product_code' ]      = $products->product_code;
                $nested_data[ 'added' ]             = $products->added->name;
                $nested_data[ 'status' ]            = $products_status;
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
        $from = $request->from;
        $modal_title = 'Add Products';
        $product_code = CommonHelper::get_product_code();
        if( isset( $id ) && !empty($id) ) {
            $info = Product::find($id);
            $modal_title = 'Update Product';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'product_code' => $product_code, 'from' => $from];
        return view('crm.products.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

    public function save(Request $request)
    {
        $id = $request->id;
        
        if( isset( $id ) && !empty($id) ) {
            $role_validator   = [
                'product_name'      => [ 'required', 'string', 'max:255', 'unique:products,product_name,'.$id ],
                'product_code'      => [ 'required', 'string', 'max:255', 'unique:products,product_code,'.$id ],
            ];
        } else {
            $role_validator   = [
                'product_name'      => [ 'required', 'string', 'max:255', 'unique:products,product_name'],
                'product_code'      => [ 'required', 'string', 'max:255', 'unique:products,product_code'],
            ];
        }
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {

            $ins['status']          = isset($request->status) ? 1 : 0;
            $ins['product_name']    = $request->product_name;
            $ins['product_code']    = $request->product_code;
            $ins['description']     = $request->description;
            
            if( isset($id) && !empty($id) ) {
                $page = Product::find($id);
                $page->status = isset($request->status) ? 1 : 0;
                $page->product_name = $request->product_name;
                $page->product_code = $request->product_code;
                $page->updated_by = Auth::id();
                $page->description = $request->description;
                $page->update();
                $success = 'Updated Product';
            } else {
                $ins['added_by'] = Auth::id();
                Product::create($ins);
                $success = 'Added new Product';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Product::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $page = Product::find($id);
        $page->status = $status;
        $page->update();
        $update_msg = 'Updated successfully';
        return response()->json(['error'=>[$update_msg], 'status' => '0']);
    }
}
