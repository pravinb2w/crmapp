<?php

namespace App\Http\Controllers;

use App\Helpers\MailEntryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Lead;
use App\Models\Deal;
use App\Models\User;
use App\Models\Customer;
use App\Models\DealStage;
use App\Models\Note;
use App\Models\Product;
use App\Models\Activity;
use App\Models\DealPipline;
use App\Models\DealProduct;
use App\Models\Country;
use CommonHelper;
use App\Models\DealDocument;
use App\Models\InvoiceItem;
use App\Models\Invoice;
use App\Models\CompanySettings;
use App\Models\EmailTemplates;
use App\Mail\TestEmail;
use PDF;
use App\Mail\SubmitApproval;
use App\Models\SendMail;
use Mail;
use DB;


class DealsController extends Controller
{
    public function index(Request $request)
    {
        $params = array('btn_name' => 'Deals', 'btn_fn_param' => 'deals');
        return view('crm.deals.index', $params);
    }

    public function ajax_list(Request $request)
    {
        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = ['deal_title', 'customer_id', 'expected_completed_date', 'status', 'id'];
        $limit              = $request->input('length');
        $start              = $request->input('start');
        $order              = $columns[intval($request->input('order')[0]['column'])];
        $dir                = $request->input('order')[0]['dir'];
        $search             = $request->input('search.value');
        $total_list         = Deal::count();
        // DB::enableQueryLog();
        if ($order != 'id') {
            $list           = Deal::skip($start)->take($limit)->orderBy($order, $dir)
                ->search($search)
                ->get();
        } else {
            $list           = Deal::skip($start)->take($limit)->Latests()
                ->search($search)
                ->get();
        }
        // $query = DB::getQueryLog();
        if (empty($request->input('search.value'))) {
            $total_filtered = Deal::count();
        } else {
            $total_filtered = Deal::search($search)
                ->count();
        }

        $data           = array();
        if ($list) {
            $i = 1;
            foreach ($list as $deals) {
                $deals_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'deals\',' . $deals->id . ', 1)"> Inactive </div>';
                if ($deals->status == 1) {
                    $deals_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'deals\',' . $deals->id . ', 0)"> Active </div>';
                }
                $action = '';
                if (Auth::user()->hasAccess('deals', 'is_view')) {
                    $action .= '<a href="' . route('deals.view', ['id' => $deals->id]) . '" class="action-icon"> <i class="mdi mdi-eye"></i></a>';
                }
                if ((Auth::user()->hasAccess('deals', 'is_edit') && $deals->assigned_to != null && $deals->assigned_to == Auth::id()) || superadmin()) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'deals\', ' . $deals->id . ')"> <i class="mdi mdi-square-edit-outline"></i></a>';
                }
                if ((Auth::user()->hasAccess('deals', 'is_delete') && $deals->assigned_to != null && $deals->assigned_to == Auth::id()) || superadmin()) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'deals\', ' . $deals->id . ')"> <i class="mdi mdi-delete"></i></a>';
                }

                $nested_data['title']             = $deals->deal_title ?? '';
                $nested_data['customer']          = $deals->customer->first_name ?? 'N/A';
                $nested_data['expected_delivery'] = date('d M, Y', strtotime($deals->expected_completed_date));
                $nested_data['assigned_to']         = $deals->assignedTo->name ?? 'All';
                $nested_data['status']            = $deals_status;
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

    public function view(Request $request)
    {
        $id = $request->id;
        $info = Deal::find($id);
        $users = User::whereNotNull('role_id')->get();
        $stage = DealStage::orderBy('order_by', 'asc')->get();
        $product_list = Product::all();
        $invoice_no = CommonHelper::get_invoice_code();

        $completed_stage = [];
        $pipeline = [];
        if (isset($info->pipeline) && !empty($info->pipeline)) {
            foreach ($info->pipeline as $key => $value) {
                $completed_stage[] = $value->stage_id;
                $pipeline[] = array('id' => $value->id, 'stage_id' => $value->stage_id, 'completed_at' => $value->completed_at, 'created_at' => $value->created_at);
            }
        }
        $params = [
            'id' => $id, 'deal_id' => $id, 'info' => $info, 'stage' => $stage, 'completed_stage' => $completed_stage,
            'pipeline' => $pipeline, 'users' => $users, 'product_list' => $product_list, 'invoice_no' => $invoice_no
        ];

        return view('crm.deals.show', $params);
    }

    public function add_edit(Request $request)
    {
        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $from = $request->from;
        $lead_id = $request->lead_id;
        $modal_title = 'Add Deal';
        $stage = DealStage::orderBy('order_by', 'asc')->get();
        $users = User::whereNotNull('role_id')->get();
        $list = Product::all();

        if (isset($lead_id) && !empty($lead_id)) {
            $lead_info = Lead::find($lead_id);
        }
        if (isset($id) && !empty($id)) {
            $info = Deal::find($id);
            $modal_title = 'Update Deal';
        }
        $params = [
            'modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'lead_id' => $lead_id,
            'lead_info' => $lead_info ?? '', 'stage' => $stage ?? '', 'users' => $users, 'list' => $list, 'from' => $from
        ];
        return view('crm.deals.add_edit', $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;

        $role_validator   = [
            'customer_id'      => ['required', 'string', 'max:255'],
            'organization_id'      => ['required', 'string', 'max:255'],
            'title'      => ['required', 'string', 'max:255'],
            'deal_stage'      => ['required', 'string', 'max:255'],
            'expected_date'      => ['required', 'string', 'max:255'],
        ];

        //Validate the product
        $validator                     = Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {

            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['deal_title'] = $request->title;
            $ins['customer_id'] = $request->customer_id;
            $ins['current_stage_id'] = $request->deal_stage;
            $ins['deal_value'] = $request->deal_value;
            $ins['lead_id'] = $request->lead_id ?? null;
            $ins['product_total'] = $request->total_cost ?? null;
            $ins['expected_completed_date'] = date('Y-m-d', strtotime($request->expected_date));
            if ($request->assigned_to) {
                $ins['assinged_by'] = Auth::id();
                $ins['assigned_to'] = $request->assigned_to;
            }
            if ($request->organization_id) {
                $cus = Customer::find($request->customer_id);
                $cus->organization_id = $request->organization_id;
                $cus->update();
            }
            //get data for pipelines
            //insert in deal_piepines table
            $deal_stage = $request->deal_stage;
            $deal_stage_info = DealStage::find($deal_stage);
            $all_stages = DealStage::where('order_by', '<=', $deal_stage_info->order_by)->orderBy('order_by', 'asc')->get();

            if (isset($id) && !empty($id)) {
                $deal = Deal::find($id);
                $deal->deal_title = $request->title;
                $deal->customer_id = $request->customer_id;
                $deal->current_stage_id = $request->deal_stage;
                $deal->deal_value = $request->deal_value;
                $deal->lead_id = $request->lead_id ?? null;
                $deal->product_total = $request->total_cost ?? null;
                $deal->expected_completed_date = date('Y-m-d', strtotime($request->expected_date));
                if ($request->assigned_to) {
                    $deal->assinged_by = Auth::id();
                    $deal->assigned_to = $request->assigned_to;
                }
                $deal->status = isset($request->status) ? 1 : 0;
                $deal->update();

                $success = 'Updated Deal';
            } else {
                $ins['added_by'] = Auth::id();
                $id = Deal::create($ins)->id;
                $success = 'Added new Deal';
            }

            CommonHelper::send_deal_notification($id, $request->assigned_to, $request->id);
            if ($request->lead_id) {
                $lead = Lead::find($request->lead_id);
                $lead->status = 2;
                $lead->updated_by = Auth::id();
                $lead->update();

                CommonHelper::send_deal_conversion_notification($request->lead_id);

                $deal_info = Deal::find($id);

                //send conversion email to customer
                MailEntryHelper::dealConversion($request->lead_id, $deal_info->customer->email);
                // end send mail conversion
            }

            DealProduct::where('deal_id', $id)->forceDelete();
            DealPipline::where('deal_id', $id)->forceDelete();
            //insert in product tables
            $limit = $request->limit;
            for ($i = 0; $i < $limit; $i++) {
                $inspro = [];
                $item_field = 'item_' . $i;
                $amount_field = 'amount_' . $i;
                $quantity_field = 'quantity_' . $i;
                $price_field = 'price_' . $i;

                if ($request->$item_field) {
                    $inspro['product_id'] = $request->$item_field;
                }
                if ($request->$price_field) {
                    $inspro['price'] = $request->$price_field;
                }
                if ($request->$quantity_field) {
                    $inspro['quantity'] = $request->$quantity_field;
                }
                if ($request->$amount_field) {
                    $inspro['amount'] = $request->$amount_field;
                }
                $inspro['deal_id'] = $id;
                if ($inspro['product_id'] && $inspro['price']) {
                    DealProduct::create($inspro);
                }
            }
            //insert in pipeline
            if (isset($all_stages) && !empty($all_stages)) {
                foreach ($all_stages as $key => $value) {
                    $status                 = 'completed';
                    $completed_at           = date('Y-m-d H:i:s');
                    if ($value->id == $deal_stage) {
                        $status             = 'pending';
                        $completed_at       = null;
                    }
                    $sins                   = [];
                    $sins['deal_id']        = $id;
                    $sins['stage_id']       = $value->id;
                    $sins['status']         = $status;
                    $sins['completed_at']   = $completed_at;
                    $sins['added_by']       = Auth::id();
                    DealPipline::create($sins);
                }
            }

            return response()->json(['error' => [$success], 'status' => '0', 'lead_id' => $request->lead_id ?? '']);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }

    function product_list(Request $request)
    {
        $limit  = $request->limit;
        $list = Product::all();
        $params = ['limit' => $limit, 'list' => $list];
        return view('crm.common._product_field', $params);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        CommonHelper::send_deal_delete_notification($id);

        $role = Deal::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error' => [$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $ins['status'] = $status;
        if (Auth::user()->hasAccess('deals', 'is_edit')) {
            $leadtype = Deal::find($id);
            $leadtype->status = $status;
            $leadtype->update();
            $update_msg = 'Updated successfully';
            $status = '0';
        } else {
            $update_msg = 'You Do not have access to change status';
            $status = '1';
        }

        return response()->json(['error' => $update_msg, 'status' => $status]);
    }

    public function refresh_timeline(Request $request)
    {
        $type = $request->type;
        $deal_id = $request->deal_id;
        $done_type = $request->done_type;

        $info = Deal::with(['planned_activity', 'done_activity', 'notes', 'files'])->find($deal_id);

        return view('crm.deals._' . $type . '_pane', ['info' => $info, 'done_type' => $done_type, 'deal_id' => $deal_id]);
    }

    public function notes_save(Request $request)
    {
        $id = $request->id;

        $role_validator   = [
            'notes'      => ['required', 'string', 'max:255'],
            'deal_id'      => ['required', 'string', 'max:255'],
        ];
        //Validate the product
        $validator                     = Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {
            $deal_id  = $request->deal_id;
            $deal_info = Deal::find($deal_id);
            $notes = $request->notes;

            $ins['status'] = isset($request->status) ? $request->status : 1;
            $ins['notes'] = $request->notes ?? null;
            $ins['deal_id'] = $request->deal_id ?? null;
            $ins['customer_id'] = $deal_info->customer_id ?? null;
            $ins['user_id'] = Auth::id();
            if (isset($id) && !empty($id)) {
                $act = Note::find($id);
                $act->status = isset($request->status) ? 1 : 0;
                $act->notes = $request->notes ?? null;
                $act->deal_id = $request->deal_id ?? null;
                $act->customer_id = $request->customer_id ?? null;
                $act->user_id = Auth::id();
                $act->updated_by = Auth::id();
                $act->update();
                $success = 'Notes updated successfully';
            } else {
                $ins['added_by'] = Auth::id();
                Note::create($ins);
                $success = 'Notes added successfully';
            }
            return response()->json(['error' => [$success], 'status' => '0', 'deal_id' => $deal_id]);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }

    public function files_save(Request $request)
    {

        $role_validator   = [
            'deal_file'      => ['required'],
        ];
        //Validate the product
        $validator                     = Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {
            $deal_id = $request->deal_id;

            if ($request->hasFile('deal_file')) {
                $file                       = $request->file('deal_file')->store('deal', 'public');
                $ins['document']            = $file;
                $ins['deal_id']             = $deal_id;
                $ins['added_by']            = Auth::id();
                DealDocument::create($ins);
                $success = 'Files added successfully';
                return response()->json(['error' => [$success], 'status' => '0', 'deal_id' => $deal_id, 'type' => 'done']);
            }
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }

    public function activity_save(Request $request)
    {
        $id = $request->id;

        $role_validator   = [
            'activity_title'      => ['required', 'string', 'max:255'],
            'activity_type'      => ['required', 'string', 'max:255'],
            'start_date'      => ['required', 'string', 'max:255'],
            'start_time'      => ['required', 'string', 'max:255'],
            'due_time'      => ['required', 'string', 'max:255'],
            'due_date'      => ['required', 'string', 'max:255'],
            'deal_id'      => ['required', 'string', 'max:255'],
        ];
        //Validate the product
        $validator                     = Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {
            $deal_id  = $request->deal_id;
            $deal_info = Deal::find($deal_id);
            $start_date = $request->start_date;
            $start_date = date('Y-m-d', strtotime($start_date));
            $start_date = $start_date . ' ' . $request->start_time . ':00';
            $started_at = date('Y-m-d H:i:s', strtotime($start_date));

            $due_date = $request->due_date;
            $due_date = date('Y-m-d', strtotime($due_date));
            $due_date = $due_date . ' ' . $request->due_time . ':00';
            $due_at = date('Y-m-d H:i:s', strtotime($due_date));

            $ins['status'] = 1;
            $ins['subject'] = $request->activity_title;
            $ins['activity_type'] = $request->activity_type;
            $ins['notes'] = $request->notes ?? null;
            $ins['deal_id'] = $request->deal_id ?? null;
            $ins['customer_id'] = $deal_info->customer_id ?? null;
            $ins['started_at'] = $started_at;
            $ins['due_at'] = $due_at;
            $ins['user_id'] = $request->user_id;

            if (isset($id) && !empty($id)) {
                $activity_id = $id;
                $act = Activity::find($id);
                $act->status = 1;
                $act->subject = $request->activity_title;
                $act->activity_type = $request->activity_type;
                $act->notes = $request->notes ?? null;
                $act->deal_id = $request->deal_id ?? null;
                $act->customer_id = $request->customer_id ?? null;
                $act->started_at = $started_at;
                $act->due_at = $due_at;
                $act->user_id = $request->user_id;
                $act->updated_by = Auth::id();
                $act->update();
            } else {
                $ins['added_by'] = Auth::id();
                $activity_id = Activity::create($ins)->id;
                $success = 'Acitivity added successfully';
            }

            CommonHelper::send_deal_activity_notification($activity_id, $deal_info->assigned_to, $id);

            return response()->json(['error' => [$success], 'status' => '0', 'deal_id' => $deal_id, 'type' => 'planned']);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }

    public function make_stage_completed(Request $request)
    {

        $stage_id   = $request->stage_id;
        $deal_id    = $request->deal_id;

        $deal_info  = Deal::find($deal_id);
        $deal_stage_info = DealStage::find($deal_info->current_stage_id);
        $new_stage_info = DealStage::find($stage_id);
        if (Auth::user()->hasAccess('deals', 'is_edit')) {
            $err_status = '1';

            $stage = DealStage::orderBy('order_by', 'asc')->get();
            $all_stages = DealStage::where('order_by', '>', $deal_stage_info->order_by)->where('order_by', '<=', $new_stage_info->order_by)->orderBy('order_by', 'asc')->get();

            //condition 1 -> change current stage to completed from pending
            $pipe = DealPipline::where('deal_id', $deal_id)->where('status', 'pending')->first();
            if (isset($pipe) && !empty($pipe)) {
                $pipe->status = 'completed';
                $pipe->completed_at = date('Y-m-d H:i:s');
                $pipe->update();
            }

            $deal_info->current_stage_id = $stage_id;
            $deal_info->update();

            CommonHelper::send_deal_stage_notification($deal_id, $stage_id);

            //condition 2 -> 
            //insert in pipeline
            if (isset($all_stages) && !empty($all_stages)) {
                foreach ($all_stages as $key => $value) {
                    $status                 = 'completed';
                    $completed_at           = date('Y-m-d H:i:s');
                    if ($value->id == $stage_id) {
                        $status             = 'pending';
                        $completed_at       = null;
                    }
                    $sins                   = [];
                    $sins['deal_id']        = $deal_id;
                    $sins['stage_id']       = $value->id;
                    $sins['status']         = $status;
                    $sins['completed_at']   = $completed_at;
                    $sins['added_by']       = Auth::id();
                    DealPipline::create($sins);
                }
            }

            $info = Deal::find($deal_id);
            $completed_stage = [];
            $pipeline = [];
            if (isset($info->pipeline) && !empty($info->pipeline)) {
                foreach ($info->pipeline as $key => $value) {
                    $completed_stage[] = $value->stage_id;
                    $pipeline[] = array('id' => $value->id, 'stage_id' => $value->stage_id, 'completed_at' => $value->completed_at, 'created_at' => $value->created_at);
                }
            }
            $view = view('crm.deals._pipeline_view', [
                'info' => $info, 'stage' => $stage,
                'completed_stage' => $completed_stage, 'pipeline' => $pipeline, 'id' => $deal_id
            ]);
            $error = 'Status changed successfully';
        } else {
            $err_status = '0';
            $error = 'You Do not have access to change status';
            $view = '';
        }

        return response()->json(['error' => $error, 'status' => $err_status, 'view' => $view]);
    }

    public function deal_finalize(Request $request)
    {

        $status = $request->status;
        $id = $request->id;
        $deal = Deal::find($id);
        if ($status == 2) {
            $deal->won_at = date('Y-m-d H:i:s');
        } else if ($status == 3) {
            $deal->loss_at = date('Y-m-d H:i:s');
        } else if ($status == 1) {
            $deal->won_at = null;
            $deal->loss_at = null;
        }
        $deal->status = $status;
        $deal->update();
        CommonHelper::send_deal_winLoss_notification($id, $status);


        $stage = DealStage::orderBy('order_by', 'asc')->get();
        // 
        $info = Deal::find($id);
        $completed_stage = [];
        $pipeline = [];
        if (isset($info->pipeline) && !empty($info->pipeline)) {
            foreach ($info->pipeline as $key => $value) {
                $completed_stage[] = $value->stage_id;
                $pipeline[] = array('id' => $value->id, 'stage_id' => $value->stage_id, 'completed_at' => $value->completed_at, 'created_at' => $value->created_at);
            }
        }
        return view('crm.deals._info', [
            'info' => $info, 'stage' => $stage,
            'completed_stage' => $completed_stage, 'pipeline' => $pipeline, 'id' => $id
        ]);
    }

    function invoice_product_list(Request $request)
    {
        $limit  = $request->limit;
        $with_tax = $request->with_tax;
        $product_list = Product::all();
        $params = ['limit' => $limit, 'product_list' => $product_list, 'with_tax' => $with_tax];
        return view('crm.invoice._items', $params);
    }

    public function insert_invoice(Request $request)
    {

        $deal_id = $request->deal_id;
        $customer_id = $request->customer_id;
        $address = $request->address;
        $email = $request->email;
        $invoice_no = $request->invoice_no;
        $issue_date = $request->issue_date;
        $due_days = $request->due_days;
        $currency = $request->currency;
        $remarks = $request->remarks;
        $limit = $request->limit;
        $total_cost = $request->total_cost;
        //insert in invoice
        $ins['deal_id'] = $deal_id;
        $ins['invoice_no'] = $invoice_no;
        $ins['issue_date'] = date('Y-m-d', strtotime($issue_date));
        $ins['due_days'] = $request->due_days;
        $ins['due_date'] = date('Y-m-d', strtotime($ins['issue_date'] . '+' . $due_days . ' Days'));
        $ins['customer_id'] = $customer_id;
        $ins['address'] = $address;
        $ins['email'] = $email;
        $ins['remarks'] = $remarks ?? null;
        $ins['currency'] = $currency ?? null;
        // $ins['subtotal'] = 
        // $ins['tax'] = 
        // $ins['discount'] = 
        $ins['total'] = $total_cost;
        $ins['status'] = 0;
        $ins['added_by'] = Auth::id();

        $invoice_id = Invoice::create($ins)->id;

        $up_data = [];
        for ($i = 1; $i <= $limit; $i++) {
            $ups['invoice_id'] = $invoice_id;
            if (isset($_POST['item_' . $i])) {
                $ups['product_id'] = $_POST['item_' . $i] ?? '';
                $ups['description'] = $_POST['description_' . $i] ?? '';
                $ups['qty'] = $_POST['quantity_' . $i] ?? '';
                $ups['unit_price'] = $_POST['unit_price_' . $i] ?? '';
                $ups['discount'] = (!empty($_POST['discount_' . $i]) ? $_POST['discount_' . $i] : 0);
                $ups['cgst'] = (!empty($_POST['cgst_' . $i]) ? $_POST['cgst_' . $i] : 0);
                $ups['sgst'] = (!empty($_POST['sgst_' . $i]) ? $_POST['sgst_' . $i] : 0);
                $ups['igst'] = (!empty($_POST['igst_' . $i]) ? $_POST['igst_' . $i] : 0);
                $ups['amount'] = $_POST['amount_' . $i] ?? 0;

                InvoiceItem::create($ups);
            }
        }
        $pdf_template = $request->pdf_template;
        $this->generatePDF($invoice_id, $pdf_template);
        $success = 'Invoice added successfully';
        return response()->json(['error' => [$success], 'status' => '0', 'deal_id' => $deal_id]);
    }

    public function generatePDF($id, $pdf_template = '')
    {
        $info = Invoice::find($id);
        $company = CompanySettings::find(1);
        $taxable = DB::table('invoice_items')
            ->join('products', 'invoice_items.product_id', '=', 'products.id')
            ->select('products.hsn_no', 'invoice_items.qty', 'invoice_items.unit_price', DB::raw('(invoice_items.qty * invoice_items.unit_price) as price'), 'invoice_items.cgst', 'invoice_items.sgst', 'invoice_items.igst')
            ->where('invoice_items.invoice_id', $id)
            ->groupBy('products.hsn_no')
            ->get();
        $data = [
            'info' => $info,
            'company' => $company,
            'taxable' => $taxable,
        ];
        // return view('crm.invoice.templates.invoice_template_two', $data);

        if (!empty($pdf_template)) {
            $pdf = PDF::loadView('crm.invoice.templates.invoice_template_' . $pdf_template, $data);
            $path = public_path('invoice');
            return $pdf->save($path . '/' . str_replace("/", "_", $info->invoice_no) . '.pdf');
        } else {
            $pdf = PDF::loadView('mypdf', $data);
            $path = public_path('invoice');
            return $pdf->save($path . '/' . str_replace("/", "_", $info->invoice_no) . '.pdf');
        }

        // return $pdf->download($info->invoice_no.'.pdf');
    }

    public function unlink_invoice(Request $request)
    {
        $deal_id = $request->deal_id;
        $invoice_id = $request->invoice_id;
        $type = $request->invoice_id;

        $invoice = Invoice::find($invoice_id);
        $invoice->delete();
        $success = 'Invoice Deleted successfully';
        return response()->json(['error' => [$success], 'status' => '0', 'deal_id' => $deal_id, 'type' => 'done']);
    }

    public function submit_for_approve(Request $request)
    {
        CommonHelper::setMailConfig();

        $deal_id = $request->deal_id;
        $invoice_id = $request->invoice_id;
        $type = $request->invoice_id;
        $deal_info = Deal::find($deal_id);

        $info = Invoice::find($invoice_id);
        $company = CompanySettings::find(1);

        $body = [
            'name' => $deal_info->customer->first_name,
            'invoice_no' => $info->invoice_no,
            // 'html' => view('crm.invoice._mail_invoice', ['info' => $info, 'company' => $company]),
            'url_a' => route('approve-invoice', ['id' => $invoice_id]),
            'url_b' => route('reject-invoice', ['id' => $invoice_id]),
        ];

        // $send_mail = new SubmitApproval($body);
        // return $send_mail->render();
        // Mail::to($info->customer->emails ?? 'durai@yopmail.com')->send($send_mail);

        $ins_mail = array(
            'type' => 'invoice',
            'type_id' => $invoice_id,
            'email_type' => 'invoice_approval',
            'params' => json_encode($body),
            'to' => $deal_info->customer->email,
            'send_type' => 'customer'
        );
        SendMail::create($ins_mail);

        $invoice = Invoice::find($invoice_id);
        $invoice->pending_at = date('Y-m-d H:i:s');
        $invoice->update();
        $success = 'Invoice Submitted for Approval successfully';
        return response()->json(['error' => [$success], 'status' => '0', 'deal_id' => $deal_id, 'type' => 'done']);
    }

    public function delete_activity(Request $request)
    {
        $deal_id = $request->deal_id;
        $activity_id = $request->activity_id;
        $type = $request->type;
        $lead_type = $request->lead_type;
        if ($lead_type == 'files') {
            $file = DealDocument::find($activity_id);
            $file->delete();
        } else if ($lead_type == 'invoice') {
            $invoice = Invoice::find($activity_id);
            $invoice->delete();
        } else if ($lead_type == 'note') {
            $role = Note::find($activity_id);
            $role->delete();
        } else if (!empty($lead_type)) {
            CommonHelper::send_deal_activity_delete_notification($activity_id, $deal_id);

            $role = Activity::find($activity_id);
            $role->delete();
        }
        return response()->json(['status' => '0', 'deal_id' => $deal_id, 'type' => $type]);
    }

    public function get_tab(Request $request)
    {
        $tab = $request->tab;
        $id = $request->deal_id;
        $country = Country::all();
        $info = Deal::with(['all_activity', 'notes'])->find($id);
        $invoice_no = CommonHelper::get_invoice_code();

        $users = User::whereNotNull('role_id')->get();
        return view('crm.deals._' . $tab . '_form', ['id' => $id, 'info' => $info, 'users' => $users, 'invoice_no' => $invoice_no, 'country' => $country]);
    }

    public function get_product_tax(Request $request)
    {
        $product_id = $request->product_id;
        $limit = $request->limit;

        $product_info = Product::find($product_id);
        $response = ['cgst' => $product_info->cgst ?? '', 'sgst' => $product_info->sgst ?? '', 'igst' => $product_info->igst, 'description' => $product_info->description];
        return response()->json($response);
    }

    public function make_stage_completed_pipline(Request $request)
    {
        $stage      = $request->stage;
        $deal_id    = $request->deal_id;

        $deal_info  = Deal::find($deal_id);
        $deal_stage_info = DealStage::find($deal_info->current_stage_id);
        $new_stage_info = DealStage::where('stages', $stage)->first();

        if (Auth::user()->hasAccess('deals', 'is_edit')) {
            $status = '1';
            if ($deal_stage_info->order_by < $new_stage_info->order_by) {

                $stage = DealStage::orderBy('order_by', 'asc')->get();
                $all_stages = DealStage::where('order_by', '>', $deal_stage_info->order_by)->where('order_by', '<=', $new_stage_info->order_by)->orderBy('order_by', 'asc')->get();

                //condition 1 -> change current stage to completed from pending
                $pipe = DealPipline::where('deal_id', $deal_id)->where('status', 'pending')->first();
                if (isset($pipe) && !empty($pipe)) {
                    $pipe->status = 'completed';
                    $pipe->completed_at = date('Y-m-d H:i:s');
                    $pipe->update();
                }

                $deal_info->current_stage_id = $new_stage_info->id;
                $deal_info->update();
                //condition 2 -> 
                //insert in pipeline
                if (isset($all_stages) && !empty($all_stages)) {
                    foreach ($all_stages as $key => $value) {
                        $status                 = 'completed';
                        $completed_at           = date('Y-m-d H:i:s');
                        if ($value->id == $new_stage_info->id) {
                            $status             = 'pending';
                            $completed_at       = null;
                        }
                        $sins                   = [];
                        $sins['deal_id']        = $deal_id;
                        $sins['stage_id']       = $value->id;
                        $sins['status']         = $status;
                        $sins['completed_at']   = $completed_at;
                        $sins['added_by']       = Auth::id();
                        DealPipline::create($sins);
                    }
                }
                $status = '1';
                $error = 'Stage moved successfully';
            } else {
                $status = '0';
                $error = 'You can not move to already done stages';
            }
        } else {
            $status = '0';
            $error = 'You Do not have access to change status';
        }
        return response()->json(['error' => $error, 'status' => $status]);
    }

    public function get_deal_common_sub_list(Request $request)
    {
        $deal_id = $request->deal_id;
        $list_type = $request->list_type;

        $type = $request->type;
        $deal_id = $request->deal_id;

        $info = Deal::with(['all_activity', 'notes', 'files'])->find($deal_id);
        $list = [];
        return view('crm.deals._common_sub_list', ['info' => $info, 'list_type' => $list_type, 'deal_id' => $deal_id]);
    }

    public function change_pdf_template(Request $request)
    {
        $data = [
            "modal_title" => "Change Invoice Template"
        ];
        return view('crm.deals._change_pdf_template', $data);
    }
}