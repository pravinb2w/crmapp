<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Models\CustomerDocument;
use Illuminate\Http\Request;
use Auth;
use File;
use Illuminate\Support\Facades\Storage;


class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $params = array('btn_name' => 'Customers Document Approval', 'btn_fn_param' => '');
        return view('crm.document.index', $params);
    }

    public function ajax_list(Request $request)
    {

        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = ['customers.first_name', 'kyc_document_types.document_name', 'uploadAt','approvedAt','rejectedAt', 'status', 'id'];

        $limit              = $request->input('length');
        $start              = $request->input('start');
        $order              = $columns[intval($request->input('order')[0]['column'])];
        $dir                = $request->input('order')[0]['dir'];
        $search             = $request->input('search.value');

        $total_list         = CustomerDocument::count();
        // DB::enableQueryLog();
        if ($order != 'id') {

            $list               = CustomerDocument::select('customer_documents.*', 'customers.first_name', 'customers.email', 'customers.mobile_no', 'kyc_document_types.document_name' )
                                    ->join('customers', 'customers.id', '=', 'customer_documents.customer_id')
                                    ->join('kyc_document_types', 'kyc_document_types.id', '=', 'customer_documents.document_id')
                                    ->skip($start)
                                    ->take($limit)
                                    ->search($search)
                                    ->orderBy($order, $dir)
                                    ->get();
           
        } else {
            $list               = CustomerDocument::join('customers', 'customers.id', '=', 'customer_documents.customer_id')
                                    ->join('kyc_document_types', 'kyc_document_types.id', '=', 'customer_documents.document_id')
                                    ->skip($start)
                                    ->take($limit)
                                    ->Latests()
                                    ->search($search)
                                    ->get();
        }
        // $query = DB::getQueryLog();
        if (empty($request->input('search.value'))) {
            $total_filtered = CustomerDocument::count();
        } else {
            $total_filtered = CustomerDocument::join('customers', 'customers.id', '=', 'customer_documents.customer_id')
                                ->join('kyc_document_types', 'kyc_document_types.id', '=', 'customer_documents.document_id')
                                ->search($search)
                                ->count();
        }

        $data               = array();
        if ($list) {
            $i = 1;
            foreach ($list as $customers) {
                $customers_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'customers\',' . $customers->id . ', 1)"> '.strtoupper($customers->status).' </div>';
                if ($customers->status == 'approved') {
                    $customers_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'customers\',' . $customers->id . ', 0)"> '.strtoupper($customers->status).' </div>';
                }
                $action = '';
                if (Auth::user()->hasAccess('customer_document_approval', 'is_view')) {
                    $action .= '<a href="'.route('customer_document_approval.customer.view', ['id' => $customers->id]).'" target="_blank" class="action-icon" > <i class="mdi mdi-eye"></i></a>';
                }
               

                $nested_data['customer']        = $customers->first_name;
                $nested_data['document']        = $customers->document_name ?? 'N/A';
                $nested_data['uploadAt']        = date('Y-m-d H:i A', strtotime( $customers->uploadAt ) );
                $nested_data['approvedAt']      = $customers->approvedAt ? date('Y-m-d H:i A', strtotime( $customers->approvedAt ) ) : 'n/a';
                $nested_data['rejectedAt']      = $customers->rejectedAt ? date('Y-m-d H:i A', strtotime( $customers->rejectedAt ) ) : 'n/a';
                $nested_data['status']          = $customers_status;
                $nested_data['action']          = $action;
                $data[]                         = $nested_data;
            }
        }

        return response()->json([
            'draw'              => intval($request->input('draw')),
            'recordsTotal'      => intval($total_list),
            'data'              => $data,
            'recordsFiltered'   => intval($total_filtered)
        ]);
    }

    public function customerView(Request $request)
    {
        if( !$request->id ) {
            return redirect()->route('login');
        }
        $info = CustomerDocument::find($request->id);
        return view('crm.document.view', compact('info'));
    }

    public function changeDocumentStatus(Request $request ) {
        $info = CustomerDocument::find($request->id);
        $info->status = $request->status;
        if( $request->status == 'approved') {
            $info->approvedAt = date('Y-m-d H:i:s');
            $info->approvedBy = Auth::id();
            $info->reject_reason = null;
            $info->rejectedBy = null;
            $info->rejectedAt = null;
        } else {
            $info->rejectedAt = date('Y-m-d H:i:s');
            $info->rejectedBy = Auth::id();
            $info->reject_reason = $request->reason;
            $info->approvedAt = null;
            $info->approvedBy = null;

        }
        $info->update();
        CommonHelper::sendDocumentStatusCustomer($info->customer_id, $info->id, $request->status);
        return response()->json(['error' => ['Update success'], 'status' => '1']);

    }
}
