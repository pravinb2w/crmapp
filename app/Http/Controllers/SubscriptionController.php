<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;

class SubscriptionController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Subscriptions', 'btn_fn_param' => 'subscriptions');
        return view('crm.subscription.index', $params);
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
                $action = '<a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
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
        $modal_title = 'Add Subscriptions';
        if( isset( $id ) && !empty($id) ) {
            $info = Subscription::find($id);
            $modal_title = 'Update Subscriptions';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.subscription.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

    public function save(Request $request)
    {
        $id = $request->id;
        if( isset( $id ) && !empty($id) ) {
            $role_validator   = [
                'subscription_name'      => [ 'required', 'string', 'max:255', 'unique:subscriptions,subscription_name,'.$id ],
            ];
        } else {
            $role_validator   = [
                'subscription_name'      => [ 'required', 'string', 'max:255', 'unique:subscriptions,subscription_name' ],
            ];
        }
        $role_validator['subscription_period'] = ['required', 'numeric'];
        $role_validator['amount'] = ['required', 'numeric'];

        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {

            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['subscription_name'] = $request->subscription_name;
            $ins['subscription_period'] = $request->subscription_period.'-'.$request->duration;
            $ins['no_of_clients'] = $request->no_of_clients ?? null;
            $ins['no_of_employees'] = $request->no_of_employees ?? null;
            $ins['no_of_leads'] = $request->no_of_leads ?? null;
            $ins['no_of_deals'] = $request->no_of_deals ?? null;
            $ins['no_of_pages'] = $request->no_of_pages ?? null;
            $ins['no_of_email_templates'] = $request->no_of_email_templates ?? null;
            $ins['bulk_import'] = $request->bulk_import ?? null;
            $ins['database_backup'] = $request->database_backup ?? null;
            $ins['work_automation'] = $request->work_automation ?? null;
            $ins['telegram_bot'] = $request->telegram_bot ?? null;
            $ins['sms_integration'] = $request->sms_integration ?? null;
            $ins['payment_gateway'] = $request->payment_gateway ?? null;
            $ins['business_whatsapp'] = $request->business_whatsapp ?? null;
            $ins['amount'] = $request->amount;

            if( isset($id) && !empty($id) ) {
                $ins['updated_by'] = Auth::id();
                Subscription::whereId($id)->update($ins);
                $success = 'Updated subscriptions';
            } else {
                $ins['added_by'] = Auth::id();
                Subscription::create($ins);
                $success = 'Added new subscription';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Subscription::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }
}
