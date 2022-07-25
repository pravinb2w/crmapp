<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Helpers\MailEntryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
use App\Models\Customer;
use App\Models\CustomerEmail;
use App\Models\CustomerMobile;

class CustomerController extends Controller
{
    public function index()
    {
        $params = array('btn_name' => 'Customers', 'btn_fn_param' => 'customers');
        return view('crm.customers.index', $params);
    }

    public function ajax_list(Request $request)
    {

        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = ['first_name', 'email', 'id', 'mobile_no', 'status', 'id'];

        $limit              = $request->input('length');
        $start              = $request->input('start');
        $order              = $columns[intval($request->input('order')[0]['column'])];
        $dir                = $request->input('order')[0]['dir'];
        $search             = $request->input('search.value');

        $total_list         = Customer::count();
        // DB::enableQueryLog();
        if ($order != 'id') {
            $list               = Customer::skip($start)->take($limit)->orderBy($order, $dir)
                ->search($search)
                ->get();
        } else {
            $list               = Customer::skip($start)->take($limit)->Latests()
                ->search($search)
                ->get();
        }
        // $query = DB::getQueryLog();
        if (empty($request->input('search.value'))) {
            $total_filtered = Customer::count();
        } else {
            $total_filtered = Customer::search($search)
                ->count();
        }

        $data           = array();
        if ($list) {
            $i = 1;
            foreach ($list as $customers) {
                $customers_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'customers\',' . $customers->id . ', 1)"> Inactive </div>';
                if ($customers->status == 1) {
                    $customers_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'customers\',' . $customers->id . ', 0)"> Active </div>';
                }
                $action = '';
                if (Auth::user()->hasAccess('customers', 'is_view')) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return view_modal(\'customers\', ' . $customers->id . ')"> <i class="mdi mdi-eye"></i></a>';
                }
                if (Auth::user()->hasAccess('customers', 'is_edit')) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'customers\', ' . $customers->id . ')"> <i class="mdi mdi-square-edit-outline"></i></a>';
                }
                if (Auth::user()->hasAccess('customers', 'is_delete')) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'customers\', ' . $customers->id . ')"> <i class="mdi mdi-delete"></i></a>';
                }

                $nested_data['first_name']        = $customers->first_name;
                $nested_data['company']             = $customers->company->name ?? 'N/A';
                $nested_data['email']             = $customers->email ?? 'N/A';
                $nested_data['mobile_no']         = $customers->mobile_no ?? 'N/A';
                $nested_data['status']            = $customers_status;
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
        $from = $request->from;
        $modal_title = 'Add Customer';
        if (isset($id) && !empty($id)) {
            $info = Customer::with(['secondary_email', 'secondary_mobile'])->find($id);
            $modal_title = 'Update Customer';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'from' => $from];
        return view('crm.customers.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

    public function view(Request $request)
    {
        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Customer Info';
        $info = Customer::with(['secondary_email', 'secondary_mobile'])->find($id);
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.customers.view', $params);
    }

    public function autocomplete_organization(Request $request)
    {
        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }
        $query              = $request->org;
        $list               = Organization::search($query)
            ->get();
        $params['list']     = $list;
        $params['query']    = $query;
        return view('crm.common._autocomplete_org', $params);
    }

    public function autocomplete_organization_save(Request $request)
    {
        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id  = $_POST['id'];
        $query = $_POST['query'] ?? '';
        if (empty($id)) {
            $ins['name'] = $query;
            $ins['added_by'] = Auth::id();
            $ins['status'] = 1;
            $id = Organization::create($ins)->id;
            $params['name'] = $query;
            $params['id'] = $id;
        } else {
            $info = Organization::find($id);
            $params['name'] = $info->name;
            $params['id'] = $info->id;
        }
        return response()->json($params);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        if (isset($id) && !empty($id)) {
            $role_validator   = [
                'first_name'       => ['required', 'string', 'max:255'],
                'email'      => ['nullable', 'string', 'max:255', 'unique:customers,email,' . $id],
                'mobile_no'  => ['nullable', 'string', 'max:255', 'unique:customers,mobile_no,' . $id],

            ];
        } else {
            $role_validator   = [
                'first_name' => ['required', 'string', 'max:255'],
                'email' => ['nullable', 'email', 'unique:customers'],
                'mobile_no' => ['nullable', 'digits:10', 'unique:customers']
            ];
        }
        //Validate the product
        $validator                     = Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {

            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['first_name'] = $request->first_name;
            $ins['last_name'] = $request->last_name;
            $ins['organization_id'] = $request->organization_id;
            $ins['email'] = $request->email;
            $ins['mobile_no'] = $request->mobile_no;

            if (isset($id) && !empty($id)) {
                $sett = Customer::find($id);
                $sett->status = isset($request->status) ? 1 : 0;
                $sett->first_name = $request->first_name;
                $sett->last_name = $request->last_name;
                $sett->organization_id = $request->organization_id;
                $sett->email = $request->email;
                $sett->mobile_no = $request->mobile_no;
                $sett->update();
                $success = 'Updated Customer';
                $customer_id = $id;
            } else {
                $ins['added_by'] = Auth::id();
                $customer_id = Customer::create($ins)->id;
                $success = 'Added new Customer';
                //send notiifcation to internal teams and mails
                CommonHelper::send_new_customer_notification($customer_id);
                MailEntryHelper::welcomeMessage($customer_id, $request->email);
            }
            //insert in customer mobile and emails
            CustomerMobile::where('customer_id', $customer_id)->forceDelete();
            CustomerEmail::where('customer_id', $customer_id)->forceDelete();

            $secondary_phone = $request->secondary_phone;
            if (isset($secondary_phone) && !empty($secondary_phone)) {
                foreach ($secondary_phone as $value) {
                    if (!empty($value)) {
                        $cust['mobile_no'] = $value;
                        $cust['customer_id'] = $customer_id;
                        $cust['description'] = 'manual';
                        $cust['status'] = 1;
                        $cust['added_by'] = Auth::id();
                        CustomerMobile::create($cust);
                    }
                }
            }
            $secondary_email = $request->secondary_email;
            if (isset($secondary_email) && !empty($secondary_email)) {
                foreach ($secondary_email as $value) {
                    if (!empty($value)) {
                        $cust1['email'] = $value;
                        $cust1['customer_id'] = $customer_id;
                        $cust1['description'] = 'manual';
                        $cust1['status'] = 1;
                        $cust1['added_by'] = Auth::id();
                        CustomerEmail::create($cust1);
                    }
                }
            }
            return response()->json(['error' => [$success], 'status' => '0']);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Customer::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error' => [$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        if (Auth::user()->hasAccess('customers', 'is_edit')) {
            $role = Customer::find($id);
            $role->status = $status;
            $role->update();
            $update_msg = 'Updated successfully';
            $status = '0';
        } else {
            $update_msg = 'You Do not have access to change status';
            $status = '1';
        }

        return response()->json(['error' => $update_msg, 'status' => $status]);
    }

    public function autocomplete_customer(Request $request)
    {
        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }
        $query              = $request->org;
        $type               = $request->type;
        $list               = Customer::search($query)
            ->get();
        $params['list']     = $list;
        $params['query']    = $query;
        $params['type']     = $type ?? '';

        return view('crm.common._autocomplete_customer', $params);
    }

    public function autocomplete_customer_save(Request $request)
    {
        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id  = $_POST['id'];
        $query = $_POST['query'] ?? '';
        $type = $_POST['type'] ?? '';

        if (empty($id)) {
            $ins['first_name'] = $query;
            $ins['added_by'] = Auth::id();
            $ins['status'] = 1;
            $id = Customer::create($ins)->id;
            $info = Customer::find($id);
            $params['name'] = $query;
            $params['id'] = $id;
            $params['company_id'] = $info->organization_id;
            $params['company'] = $info->company->name ?? '';
        } else {
            $info = Customer::find($id);
            $params['name'] = $info->first_name;
            $params['id'] = $info->id;
            $params['company_id'] = $info->organization_id;
            $params['company'] = $info->company->name ?? '';
        }
        return response()->json($params);
    }
}