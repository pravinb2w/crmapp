<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceItem;
use App\Models\Invoice;
use App\Models\Deal;
use App\Models\CompanySettings;
use App\Models\Order;
use App\Models\Payment;
use PDF;
use CommonHelper;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $params = [];
        return view('crm.invoice.index', $params);
    }

    public function ajax_list(Request $request)
    {
        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = ['invoice_no', 'issue_date', 'deal_id', 'status', 'id'];
        $limit              = $request->input('length');
        $start              = $request->input('start');
        $order              = $columns[intval($request->input('order')[0]['column'])];
        $dir                = $request->input('order')[0]['dir'];
        $search             = $request->input('search.value');
        $total_list         = Invoice::count();
        // DB::enableQueryLog();
        if ($order != 'id') {
            $list           = Invoice::skip($start)->take($limit)->orderBy($order, $dir)
                ->search($search)
                ->get();
        } else {
            $list           = Invoice::skip($start)->take($limit)->Latests()
                ->search($search)->orderBy('id', 'DESc')
                ->dd();
        }
        // $query = DB::getQueryLog();
        if (empty($request->input('search.value'))) {
            $total_filtered = Invoice::count();
        } else {
            $total_filtered = Invoice::search($search)
                ->count();
        }

        $data           = array();
        if ($list) {
            $i = 1;
            foreach ($list as $inv) {
                if (empty($inv->pending_at) && empty($inv->approved_at)) {
                    $inv_status                     = '<div class="badge bg-info" role="button"> Pending </div>';
                } else if (!empty($inv->pending_at) && empty($inv->approved_at)) {
                    $inv_status                     = '<div class="badge bg-warning" role="button"> Awaiting Approval </div>';
                } else if (!empty($inv->approved_at)) {
                    $inv_status                     = '<div class="badge bg-success" role="button"> Approved </div>';
                } else if (!empty($inv->rejected_at)) {
                    $inv_status                     = '<div class="badge bg-danger" role="button"> Rejected </div>';
                }

                $action = '<a href="javascript:void(0);" onclick="return view_invoice(' . $inv->id . ')" class="action-icon"> <i class="mdi mdi-eye"></i></a>';

                $nested_data['invoice_no']        = $inv->invoice_no ?? '';
                $nested_data['deal']              = $inv->deal->deal_title ?? 'N/A';
                $nested_data['invoice_date']        = date('d-M-Y', strtotime($inv->issue_date));
                $nested_data['status']            = $inv_status;
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
        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Invoice Info';
        $info = Invoice::find($id);
        $company = CompanySettings::find(1);

        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'company' => $company];
        return view('crm.invoice.view', $params);
    }

    public function approve_invoice(Request $request, $id)
    {

        $info = Invoice::find($id);
        if (isset($info->approved_at) && !empty($info->approved_at)) {
            $params['status'] = 1;
            $params['message'] = 'Session expired or already approved';
        } else {
            $params['status'] = 0;
            $params['message'] = 'Congratulation Your have approved proposal Succsussfully';
            $info->approved_at = date('Y-m-d H:i:s');
            $info->update();

            $order_no = 'TXN' . date('mdyhis');
            $temp_no = base64_encode('TEMP' . date('mdyhis'));

            $ord_ins['order_id'] = $order_no;
            $ord_ins['amount'] = $info->total;
            $ord_ins['customer_id'] = $info->customer_id;
            $ord_ins['product_code'] = null;
            $ord_ins['payment_gateway'] = 'razorpay';
            $ord_ins['description'] = 'Invoice approval via order confirmation';
            $ord_ins['status'] = 'pending';

            Order::create($ord_ins);

            $ins['payment_mode'] = 'online';
            $ins['customer_id'] = $info->customer_id;
            $ins['amount'] = $info->total;
            $ins['invoice_id'] = $id;
            $ins['deal_id'] = $info->deal_id ?? null;
            $ins['payment_method'] = 'razor';
            $ins['order_id'] = $order_no;
            $ins['payment_status'] = 'pending';
            $ins['temp_no'] = $temp_no;
            Payment::create($ins);
            $success = 'Payment Added';

            $route = route('razorpay.request', ['order_no' => $order_no]);
            $params['route'] = $route;
            //here need to do payment process

        }
        return view('mail-message', $params);
    }

    public function reject_invoice(Request $request, $id)
    {

        $info = Invoice::find($id);
        if (isset($info->rejected_at) && !empty($info->rejected_at)) {
            $params['status'] = 1;
            $params['message'] = 'Session expired or already rejected';
        } else {
            $params['status'] = 2;
            $params['message'] = 'Sorry! Your have rejected proposal';
            $info->rejected_at = date('Y-m-d H:i:s');
            $info->update();
        }
        return view('mail-message', $params);
    }
    public function template_index(Request $request)
    {
        return view('crm.invoice.templates.index');
    }
    public function template_download(Request $request)
    {
        $data = [
            "title" => "New Invoice type"
        ];

        $pdf = PDF::loadView('crm.invoice.templates.invoice_type_one', $data);
        return $pdf->download('test.pdf');
    }
}
