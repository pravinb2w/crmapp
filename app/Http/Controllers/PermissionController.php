<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermissionMenu;

class PermissionController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Permission', 'btn_fn_param' => 'permissions');
        return view('crm.permission.index', $params);
    }

    public function ajax_list(Request $request)
    {

        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = ['role_id', 'addedBy', 'id'];

        $limit              = $request->input('length');
        $start              = $request->input('start');
        $order              = $columns[intval($request->input('order')[0]['column'])];
        $dir                = $request->input('order')[0]['dir'];
        $search             = $request->input('search.value');

        $total_list         = Permission::count();
        // DB::enableQueryLog();
        if ($order != 'id') {
            $list           = Permission::skip($start)->take($limit)->whereRaw('created_at')->orderBy($order, $dir)
                ->search($search)
                ->get();
        } else {
            $list           = Permission::skip($start)->take($limit)->whereRaw('created_at')->Latests()
                ->search($search)
                ->get();
        }
        // $query = DB::getQueryLog();
        if (empty($request->input('search.value'))) {
            $total_filtered = Permission::count();
        } else {
            $total_filtered = Permission::search($search)
                ->count();
        }

        $data           = array();
        if ($list) {
            $i = 1;
            foreach ($list as $permissions) {

                $action = '<a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'permissions\', ' . $permissions->id . ')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'permissions\', ' . $permissions->id . ')"> <i class="mdi mdi-delete"></i></a>';


                $nested_data['role']              = $permissions->role->role;
                $nested_data['addedBy']             = $permissions->added->name ?? '';
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
        $modal_title = 'Add Role Permissions';
        $role = Role::all();
        if (isset($id) && !empty($id)) {
            $info = Permission::find($id);
            $modal_title = 'Update Role Permissions';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'role' => $role];
        return view('crm.permission.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

    public function save(Request $request)
    {
        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        if (isset($id) && !empty($id)) {
            $role_validator   = [
                'role_id'      => ['required', 'string', 'max:255', 'unique:role_permissions,role_id,' . $id],
            ];
        } else {
            $role_validator   = [
                'role_id'      => ['required', 'string', 'max:255', 'unique:role_permissions,role_id'],
            ];
        }
        //Validate the product
        $validator                     = Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {
            $role_id = $request->role_id;
            $per['role_id'] = $role_id;
            if (isset($id) && !empty($id)) {
                $per_info = Permission::find($id);
                $per_info->role_id = $role_id;
                $per_info->update();
            } else {
                $per['status'] = 1;
                $per['added_by'] = Auth::id();
                $id = Permission::create($per)->id;
            }

            RolePermissionMenu::where('permission_id', $id)->forceDelete();

            $ins = [];
            foreach (config('constant.role_menu') as $item) {
                $visible = 'visible_' . $item;
                $editable = 'editable_' . $item;
                $delete = 'delete_' . $item;
                $assign = 'assign_' . $item;
                $export = 'export_' . $item;
                $tmp['permission_id']   = $id;
                $tmp['menu']            = $item;
                $tmp['is_view']         = $request->$visible ?? 'no';
                $tmp['is_edit']         = $request->$editable ?? 'no';
                $tmp['is_delete']       = $request->$delete ?? 'no';
                $tmp['is_assign']       = $request->$assign ?? 'no';
                $tmp['is_export']       = $request->$export ?? 'no';
                $tmp['added_by'] = Auth::id();
                $tmp['created_at'] = date('Y-m-d H:i:s');
                RolePermissionMenu::create($tmp);
            }
            if (!empty($tmp)) {
                return response()->json(['error' => 'Permission added successfully', 'status' => '0']);
            }
        } else {
            return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Permission::find($id);
        $role->delete();
        RolePermissionMenu::where('permission_id', $id)->forceDelete();
        $delete_msg = 'Deleted successfully';
        $role->forceDelete();
        return response()->json(['error' => [$delete_msg], 'status' => '0']);
    }
}