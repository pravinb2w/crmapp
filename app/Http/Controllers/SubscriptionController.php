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

    public function ajax_list(Request $request)
    {

        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = ['subscription_name', 'subscription_period', 'amount', 'status', 'id'];

        $limit              = $request->input('length');
        $start              = $request->input('start');
        $order              = $columns[intval($request->input('order')[0]['column'])];
        $dir                = $request->input('order')[0]['dir'];
        $search             = $request->input('search.value');
        $approve_status     = $request->input('approve_status');

        $total_list         = Subscription::count();
        // DB::enableQueryLog();
        if ($order != 'id') {
            $list               = Subscription::skip($start)->take($limit)->orderBy($order, $dir)
                ->search($search)
                ->get();
        } else {
            $list               = Subscription::skip($start)->take($limit)->Latests()
                ->search($search)
                ->get();
        }
        // $query = DB::getQueryLog();
        if (empty($request->input('search.value'))) {
            $total_filtered = Subscription::count();
        } else {
            $total_filtered = Subscription::search($search)
                ->count();
        }

        $data           = array();
        if ($list) {
            $i = 1;
            foreach ($list as $subscriptions) {

                $subscriptions_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'subscriptions\',' . $subscriptions->id . ', 1)"> Inactive </div>';
                if ($subscriptions->status == 1) {
                    $subscriptions_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'subscriptions\',' . $subscriptions->id . ', 0)"> Active </div>';
                }

                $action = '<a href="javascript:void(0);" class="action-icon" onclick="return get_subscription_view(' . $subscriptions->id . ')"> <i class="mdi mdi-eye"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'subscriptions\', ' . $subscriptions->id . ')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'subscriptions\', ' . $subscriptions->id . ')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data['subscription_name']   = $subscriptions->subscription_name;
                $nested_data['subscription_period'] = $subscriptions->subscription_period;
                $nested_data['amount']            = $subscriptions->amount;
                $nested_data['status']            = $subscriptions_status;
                $nested_data['action']            = $action;
                $data[]                             = $nested_data;
            }
        }

        return response()->json([
            'draw'              => intval($request->input('draw')),
            'recordsTotal'      => intval($total_list),
            'data'              => $data,
            'recordsFiltered'   => intval($total_filtered)
        ]);
    }

    public function add_edit(Request $request)
    {
        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Add Subscriptions';
        if (isset($id) && !empty($id)) {
            $info = Subscription::find($id);
            $modal_title = 'Update Subscriptions';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.subscription.add_edit', $params);
    }

    public function view(Request $request)
    {
        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Subscription Info';
        $info = Subscription::find($id);
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.subscription.view', $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        if (isset($id) && !empty($id)) {
            $role_validator   = [
                'subscription_name'      => ['required', 'string', 'max:255', 'unique:subscriptions,subscription_name,' . $id],
            ];
        } else {
            $role_validator   = [
                'subscription_name'      => ['required', 'string', 'max:255', 'unique:subscriptions,subscription_name'],
            ];
        }
        $role_validator['subscription_period'] = ['required', 'numeric'];
        $role_validator['amount'] = ['required', 'numeric'];

        //Validate the product
        $validator                     = Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {
            if( $request->payment_gateway ) {
                $payment_gateway = implode(',', $request->payment_gateway);
            }

            if (isset($id) && !empty($id)) {
                $success = 'Updated subscriptions';
            } 

            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['subscription_name'] = $request->subscription_name;
            $ins['subscription_period'] = $request->subscription_period . '-' . $request->duration;
            $ins['no_of_clients'] = $request->no_of_clients ?? null;
            $ins['no_of_employees'] = $request->no_of_employees ?? null;
            $ins['no_of_deal_stages'] = $request->no_of_deal_stages ?? null;
            $ins['no_of_deals'] = $request->no_of_deals ?? null;
            $ins['no_of_pages'] = $request->no_of_pages ?? null;
            $ins['no_of_email_templates'] = $request->no_of_email_templates ?? null;
            $ins['no_of_products'] = $request->no_of_products ?? null;
            $ins['no_of_sms_templates'] = $request->no_of_sms_templates ?? null;
            $ins['work_automation'] = $request->work_automation ?? 'no';
            $ins['announcements'] = $request->announcements ?? 'no';
            $ins['bulk_upload'] = $request->bulk_upload ?? 'no';
            $ins['newletter_subscriptions'] = $request->newletter_subscriptions ?? 'no';
            $ins['tasks'] = $request->tasks ?? 'no';
            $ins['activities'] = $request->activities ?? 'no';
            $ins['payment_tracking'] = $request->payment_tracking ?? 'no';
            $ins['thirdparty_integrations'] = $request->thirdparty_integrations ?? 'no';
            $ins['technical_support'] = $request->technical_support ?? 'no';
            $ins['onetime_setup'] = $request->onetime_setup ?? 'no';
            $ins['server_procurement'] = $request->server_procurement ?? 'no';
            $ins['predefined_configurations'] = $request->predefined_configurations ?? 'no';
            $ins['payment_gateway'] = $payment_gateway?? 'no';
            $ins['server_space'] = $request->server_space ?? null;
            $ins['amount'] = $request->amount;
            $ins['added_by'] = Auth::id();
            Subscription::updateOrCreate(['id' => $id],$ins);
            $success = 'Added new subscription';
            
            return response()->json(['error' => [$success], 'status' => '0']);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Subscription::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error' => [$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $info = Subscription::find($id);
        $info->status = $status;
        $info->update();
        $update_msg = 'Updated successfully';
        return response()->json(['error' => [$update_msg], 'status' => '0']);
    }
}