<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\DealStage;

class DealStageController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Deal Stage', 'btn_fn_param' => 'dealstages');
        return view('crm.dealstage.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'stages', 'order_by','status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = DealStage::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = DealStage::orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = DealStage::orderBy('order_by', 'asc')
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = DealStage::count();
        } else {
            $total_filtered = DealStage::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $dealstages ) {
                $dealstages_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'dealstages\','.$dealstages->id.', 1)"> Inactive </div>';
                if( $dealstages->status == 1 ) {
                    $dealstages_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'dealstages\','.$dealstages->id.', 0)"> Active </div>';
                }
                $action = '<a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'dealstages\', '.$dealstages->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'dealstages\', '.$dealstages->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$dealstages->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'stages' ]            = $dealstages->stages;
                $nested_data[ 'order_by' ]          = $dealstages->order_by;
                $nested_data[ 'status' ]            = $dealstages_status;
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
        $modal_title = 'Add Deal Stages';
        if( isset( $id ) && !empty($id) ) {
            $info = DealStage::find($id);
            $modal_title = 'Update Deal Stages';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.dealstage.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

    public function save(Request $request)
    {
        $id = $request->id;
        
        if( isset( $id ) && !empty($id) ) {
            $role_validator   = [
                'stages'      => [ 'required', 'string', 'max:255'],
                'order_by' => ['required', 'string']
            ];
        } else {
            $role_validator   = [
                'stages'      => [ 'required', 'string', 'max:255', 'unique:deal_stages,stages'],
                'order_by' => ['required', 'string', 'unique:deal_stages,order_by']
            ];
        }
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {

            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['stages'] = $request->stages;
            $ins['description'] = $request->description;
            $ins['order_by'] = $request->order_by;
            
            if( isset($id) && !empty($id) ) {
                $deal = DealStage::find($id);
                $deal->status = isset($request->status) ? 1 : 0;
                $deal->stages = $request->stages;
                $deal->description = $request->description;
                $deal->order_by = $request->order_by;
                $deal->update();
                $success = 'Updated Deal Stage';
            } else {
                $ins['added_by'] = Auth::id();
                DealStage::create($ins);
                $success = 'Added new Deal Stage';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = DealStage::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $deal = DealStage::find($id);
        $deal->status = $status;
        $deal->update();
        $update_msg = 'Updated successfully';
        return response()->json(['error'=>[$update_msg], 'status' => '0']);
    }
}
