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

        $columns            = [ 'id', 'product_name',  'product_code', 'hsn_no', 'added', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = Product::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = Product::skip($start)->take($limit)->whereRaw('created_at')->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = Product::skip($start)->take($limit)->whereRaw('created_at')->Latests()
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
                $action = '';
                if(Auth::user()->hasAccess('products', 'is_view')) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return view_modal(\'products\', '.$products->id.')"> <i class="mdi mdi-eye"></i></a>';
                }
                if(Auth::user()->hasAccess('products', 'is_edit')) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'products\', '.$products->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>';
                }
                if(Auth::user()->hasAccess('products', 'is_delete')) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'products\', '.$products->id.')"> <i class="mdi mdi-delete"></i></a>';
                }

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$products->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'product_name' ]      = $products->product_name;
                $nested_data[ 'product_code' ]      = $products->product_code;
                $nested_data[ 'hsn_no' ]            = $products->hsn_no ?? '';
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
        
    }

    public function view(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Product Info';
        $info = Product::find($id);
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.products.view', $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        
        if( isset( $id ) && !empty($id) ) {
            $role_validator   = [
                'product_name'      => [ 'required', 'string', 'max:255', 'unique:products,product_name,'.$id ],
                'product_code'      => [ 'required', 'string', 'max:255', 'unique:products,product_code,'.$id ],
                'hsn_no'      => [ 'required', 'string', 'max:255' ],
            ];
        } else {
            $role_validator   = [
                'product_name'      => [ 'required', 'string', 'max:255', 'unique:products,product_name'],
                'product_code'      => [ 'required', 'string', 'max:255', 'unique:products,product_code'],
                'hsn_no'      => [ 'required', 'string', 'max:255'],
            ];
        }
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {

            $ins['status']          = isset($request->status) ? 1 : 0;
            $ins['product_name']    = $request->product_name;
            $ins['product_code']    = $request->product_code;
            $ins['hsn_no']          = $request->hsn_no;
            $ins['cgst']          = $request->cgst;
            $ins['sgst']          = $request->sgst;
            $ins['igst']          = $request->igst;
            $ins['description']     = $request->description;
            
            if( isset($id) && !empty($id) ) {
                $page = Product::find($id);
                $page->status = isset($request->status) ? 1 : 0;
                $page->product_name = $request->product_name;
                $page->product_code = $request->product_code;
                $page->hsn_no       = $request->hsn_no;
                $page->cgst       = $request->cgst;
                $page->sgst       = $request->sgst;
                $page->igst       = $request->igst;
                $page->updated_by   = Auth::id();
                $page->description  = $request->description;
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
        if(Auth::user()->hasAccess('products', 'is_edit')) {
            $page = Product::find($id);
            $page->status = $status;
            $page->update();
            $update_msg = 'Updated successfully';
            $status = '0';
        } else {
            $update_msg = 'You Do not have access to change status';
            $status = '1';
        }
        
        return response()->json(['error'=>$update_msg, 'status' => $status]);
    }
}
