<?php

namespace App\Http\Controllers;

use App\Models\CompanySubscription;
use App\Models\Subscription;
use App\Models\CompanySettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use CommonHelper;

class CompanySubscriptionController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Company Subscriptions', 'btn_fn_param' => 'company-subscriptions');
        return view('crm.company_subscription.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'subscription_name', 'company_name', 'startAt', 'endAt', 'amount', 'status', '' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
        $approve_status     = $request->input( 'approve_status' );
       
        $total_list         = CompanySubscription::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = CompanySubscription::skip($start)->take($limit)->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = CompanySubscription::skip($start)->take($limit)->Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        // dd($query);
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = CompanySubscription::count();
        } else {
            $total_filtered = CompanySubscription::search( $search )
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
                $action = '
                <a href="javascript:void(0);" class="action-icon" onclick="return view_modal(\'company-subscriptions\', '.$subscriptions->id.')"> <i class="mdi mdi-eye"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'company-subscriptions\', '.$subscriptions->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'company-subscriptions\', '.$subscriptions->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$subscriptions->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'subscription_name' ] = $subscriptions->subscription->subscription_name;
                $nested_data[ 'company_name' ]      = $subscriptions->company->site_name;
                $nested_data[ 'startAt' ]           = date('d-M-Y', strtotime($subscriptions->startAt));
                $nested_data[ 'endAt' ]             = date('d-M-Y', strtotime($subscriptions->endAt));
                $nested_data[ 'amount' ]            = $subscriptions->total_amount;
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
        $modal_title = 'Add Company Subscriptions';
        $company = CompanySettings::whereNull('created_at')->get();
        $subscriptions = Subscription::all();
        if( isset( $id ) && !empty($id) ) {
            $info = CompanySubscription::find($id);
            $modal_title = 'Update Company Subscriptions';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'company' => $company, 'subscriptions' => $subscriptions ];
        return view('crm.company_subscription.add_edit', $params);
        
    }

    public function view(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Company Subscription Info';
        $info = CompanySubscription::find($id);
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.company_subscription.view', $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        
        $role_validator   = [
            'company_id'      => [ 'required', 'string', 'max:255', 'unique:company_subscriptions' ],
            'subscription_id'      => [ 'required', 'string', 'max:255' ],
            'start_date' => ['required', 'date'],
        ];
        
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {
            $startAt = $request->start_date;
            $subscription_id = $request->subscription_id;
            $company_id = $request->company_id;
            $status = isset($request->status) ? 1 : 0;
            
            if($subscription_id){
                $sub_info = Subscription::find($subscription_id);
                $endAt = CommonHelper::getExpiry($sub_info->subscription_period, $startAt);
            }

            $ins['status'] = $status;
            $ins['company_id'] = $company_id;
            $ins['subscription_id'] = $subscription_id;
            $ins['startAt'] = date('Y-m-d', strtotime($startAt));
            $ins['endAt'] = $endAt ?? date('Y-m-d');
            $ins['total_amount'] = $request->total_amount;
            $ins['description'] = $request->description;

            $check_where = ['company_id' => $company_id, 'subscription_id' => $subscription_id];
            $ch_stat_where = ['company_id' => $company_id, 'status' => 1 ];

            $check = CompanySubscription::where($check_where)->when($id, function($q) use($id){
                            return $q->whereNotIn('id', [$id]);
                        } )->first();
            if( isset( $check ) && !empty($check)){
                $success = 'Subscription already assigned to company';
                return response()->json(['error'=>[$success], 'status' => '1']);
            }

            $check_status = CompanySubscription::where($ch_stat_where)->when($id, function($q) use($id){
                                return $q->whereNotIn('id', [$id]);
                            } )->first();
            if( isset( $check_status ) && !empty($check_status) && $status == 1 ){
                $success = 'Company already has active subscription, please create inactive subscription or you can not create it';
                return response()->json(['error'=>[$success], 'status' => '1']);
            }

            if( isset($id) && !empty($id) ) {
                $comp = CompanySubscription::find($id);
                $comp->status = $status;
                $comp->company_id = $company_id;
                $comp->subscription_id = $subscription_id;
                $comp->startAt = date('Y-m-d', strtotime($startAt));
                $comp->endAt = $endAt ?? date('Y-m-d');
                $comp->total_amount = $request->total_amount;
                $comp->description = $request->description;
                $comp->update();
                if( $status == 1 ) {
                    $info = CompanySubscription::find($id);
                    $upd['subscription_id'] = $info->id;
                    CompanySettings::whereId($company_id)->update($upd);
                }
                $success = 'Updated Company Subscription';
            } else {
    
                $ins['added_by'] = Auth::id();
                $csub = CompanySubscription::create($ins);
                
                if( $status == 1 ) {
                    $upd['subscription_id'] = $csub->id;
                    CompanySettings::whereId($company_id)->update($upd);
                }
                $success = 'Added new Company Subscription';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $csub = CompanySubscription::find($id);
        if( $csub->status == 1) {
            return response()->json(['error'=> 'You Cannot delete Active Subscription', 'status' => '1']);
        }
        $company_id = $csub->company_id;
        $csub->delete();
        $upd['subscription_id'] = null;
        CompanySettings::whereId($company_id)->update($upd);
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }
}
