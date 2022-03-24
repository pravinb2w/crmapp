<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Tax;
use App\Models\TaxGroup;

class TaxController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Tax Group', 'btn_fn_param' => 'taxgroup');
        return view('crm.tax.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'group_name', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = TaxGroup::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = TaxGroup::skip($start)->take($limit)->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = TaxGroup::skip($start)->take($limit)->Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = TaxGroup::count();
        } else {
            $total_filtered = TaxGroup::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $taxgroup ) {
                $taxgroup_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'taxgroup\','.$taxgroup->id.', 1)"> Inactive </div>';
                if( $taxgroup->status == 1 ) {
                    $taxgroup_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'taxgroup\','.$taxgroup->id.', 0)"> Active </div>';
                }
                $action = '
                <a href="javascript:void(0);" class="action-icon" onclick="return view_modal(\'taxgroup\', '.$taxgroup->id.')"> <i class="mdi mdi-eye"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'taxgroup\', '.$taxgroup->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'taxgroup\', '.$taxgroup->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$taxgroup->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'tax' ]              = $taxgroup->group_name;
                $nested_data[ 'status' ]            = $taxgroup_status;
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
