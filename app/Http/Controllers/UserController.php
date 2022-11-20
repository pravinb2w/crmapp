<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\CompanySettings;
use App\Models\Country;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use CommonHelper;

class UserController extends Controller
{
    public function index()
    {
        $params = array('btn_name' => 'Users', 'btn_fn_param' => 'users');
        return view('crm.user.index', $params);
    }

    public function ajax_list(Request $request)
    {

        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = ['name', 'email', 'mobile_no', 'status', 'id'];

        $limit              = $request->input('length');
        $start              = $request->input('start');
        $order              = $columns[intval($request->input('order')[0]['column'])];
        $dir                = $request->input('order')[0]['dir'];
        $search             = $request->input('search.value');
        $approve_status     = $request->input('approve_status');

        $total_list         = User::whereNotNull('role_id')->companyRelatedOnly()->count();
        
        // DB::enableQueryLog();
        if ($order != 'id') {
            $list               = User::skip($start)->take($limit)->whereNotNull('role_id')->orderBy($order, $dir)
                ->search($search)
                ->companyRelatedOnly()
                ->get();
        } else {
            $list               = User::skip($start)->take($limit)->whereNotNull('role_id')->Latests()
                ->search($search)
                ->companyRelatedOnly()
                ->get();
        }
        // $query = DB::getQueryLog();
        if (empty($request->input('search.value'))) {
            $total_filtered = User::whereNotNull('role_id')->companyRelatedOnly()->count();
        } else {
            $total_filtered = User::whereNotNull('role_id')->companyRelatedOnly()->search($search)
                ->count();
        }

        $data           = array();
        if ($list) {
            $i = 1;
            foreach ($list as $users) {
                $users_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'users\',' . $users->id . ', 1)"> Inactive </div>';
                if ($users->status == 1) {
                    $users_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'users\',' . $users->id . ', 0)"> Active </div>';
                }
                $action = '
                <a href="javascript:void(0);" class="action-icon" onclick="return view_modal(\'users\', ' . $users->id . ')"> <i class="mdi mdi-eye"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'users\', ' . $users->id . ')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'users\', ' . $users->id . ')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data['name']              = $users->name;
                $nested_data['role']              = $users->role->role ?? '';
                $nested_data['email']             = $users->email;
                $nested_data['mobile_no']         = ($users->dial_code ?? '').$users->mobile_no;
                $nested_data['status']            = $users_status;
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
        $modal_title = 'Add User';
        $country  = Country::all();
        $roles = Role::where('status', 1)->get();
        if (isset($id) && !empty($id)) {
            $info = User::find($id);
            $modal_title = 'Update User';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'roles' => $roles, 'country' => $country];
        return view('crm.user.add_edit', $params);
    }

    public function view(Request $request)
    {
        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'User Info';
        $info = User::find($id);
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.user.view', $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        if (isset($id) && !empty($id)) {
            $role_validator   = [
                'email'      => ['required', 'email', 'string', 'max:255', 'unique:users,email,' . $id.',id,company_id,'.auth()->user()->company_id],
                'mobile_no'      => ['required', 'digits:10', 'max:255', 'unique:users,mobile_no,' . $id.',id,company_id,'.auth()->user()->company_id],
                // 'password' => ['required', 'string', 'min:6'],

            ];
        } else {
            $role_validator   = [
                'name' => ['required', 'string', 'max:255'],
                'email'      => ['required', 'email', 'string', 'max:255', 'unique:roles,role,NULL,id,company_id,'.auth()->user()->company_id],
                'mobile_no' => ['required', 'digits:10', 'max:255'],
                'password' => ['required', 'string', 'min:6'],

            ];
        }
        //Validate the product
        $validator                     = Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {

            if ($request->hasFile('profile_image')) {
                $file                       = $request->file('profile_image')->store('account', 'public');
                $ins['image'] = $file;
            }
            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['name'] = $request->name;
            $ins['last_name'] = $request->last_name;
            $ins['mobile_no'] = $request->mobile_no;
            $ins['dial_code'] = $request->dial_code;
            $ins['role_id'] = $request->role_id;
            $ins['email'] = $request->email;
            $ins['lead_limit'] = $request->lead_limit;
            $ins['deal_limit'] = $request->deal_limit;

            if (isset($request->password)) {
                $ins['password'] = Hash::make($request->password);
            }
            // dd($ins); 
            if (isset($id) && !empty($id)) {
                $user = User::find($id);
                $user->status = isset($request->status) ? 1 : 0;
                $user->name = $request->name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->mobile_no = $request->mobile_no;
                $user->dial_code = $request->dial_code;
                $user->role_id = $request->role_id;
                $user->lead_limit = $request->lead_limit;
                $user->deal_limit = $request->deal_limit;

                if (isset($request->password)) {
                    $user->password = Hash::make($request->password);
                }
                if ($request->hasFile('profile_image')) {
                    $file        = $request->file('profile_image')->store('account', 'public');
                    $user->image = $file;
                }
                $user->save();
                $success = 'Updated User';
            } else {
                $ins['added_by'] = Auth::id();
                $id = User::create($ins)->id;
                $success = 'Added new user';
            }
            if (isset($request->status)) {
                CommonHelper::set_lead_order($id, $request->role_id, 'add');
                CommonHelper::set_deal_order($id, $request->role_id, 'add');
            }

            return response()->json(['error' => [$success], 'status' => '0']);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $info = User::find($id);
        $info->delete();
        CommonHelper::set_lead_order($id, $info->role_id, 'delete');
        CommonHelper::set_deal_order($id, $info->role_id, 'delete');

        $delete_msg = 'Deleted successfully';
        return response()->json(['error' => [$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $info = User::find($id);
        $info->status = $status;
        $info->update();
        if ($status == 1) {
            CommonHelper::set_lead_order($id, $info->role_id, 'add');
            CommonHelper::set_deal_order($id, $info->role_id, 'add');
        } else {
            CommonHelper::set_lead_order($id, $info->role_id, 'delete');
            CommonHelper::set_deal_order($id, $info->role_id, 'delete');
        }

        $update_msg = 'Updated successfully';
        return response()->json(['error' => [$update_msg], 'status' => '0']);
    }
}