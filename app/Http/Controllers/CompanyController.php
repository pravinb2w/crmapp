<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\CompanySettings;


class CompanyController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Company', 'btn_fn_param' => 'company');
        return view('crm.company.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'subscription_name', 'subscription_period', 'amount', 'status', '' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
        $approve_status     = $request->input( 'approve_status' );
       
        $total_list         = Subscription::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = Subscription::orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = Subscription::Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Subscription::count();
        } else {
            $total_filtered = Subscription::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $subscriptions ) {
                $subscriptions_status                         = '<div class="badge bg-danger"> Inactive </div>';
                if( $subscriptions->status == '1' ) {
                    $subscriptions_status                     = '<div class="badge bg-success"> Active </div>';
                }
                $action = '<a href="javascript:void(0);" class="action-icon" onclick="return get_subscription_view('.$subscriptions->id.')"> <i class="mdi mdi-eye"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'subscriptions\', '.$subscriptions->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'subscriptions\', '.$subscriptions->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$subscriptions->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'subscription_name' ]             = $subscriptions->subscription_name;
                $nested_data[ 'subscription_period' ]           = $subscriptions->subscription_period;
                $nested_data[ 'amount' ]            = $subscriptions->amount;
                $nested_data[ 'status' ]            = $subscriptions_status;
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
        $modal_title = 'Add Company';
        if( isset( $id ) && !empty($id) ) {
            $info = Subscription::find($id);
            $modal_title = 'Update Company';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.company_subscription.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

}
