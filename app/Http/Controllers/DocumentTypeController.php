<?php

namespace App\Http\Controllers;

use App\Models\KycDocumentType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;

class DocumentTypeController extends Controller
{
    public function index()
    {
        $params = array('btn_name' => 'Document Types', 'btn_fn_param' => 'document-types');
        return view('crm.customer_document_type.index', $params);
    }

    public function ajax_list(Request $request)
    {

        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = ['document_name', 'status', 'id'];

        $limit              = $request->input('length');
        $start              = $request->input('start');
        $order              = $columns[intval($request->input('order')[0]['column'])];
        $dir                = $request->input('order')[0]['dir'];
        $search             = $request->input('search.value');

        $total_list         = KycDocumentType::count();
        // DB::enableQueryLog();
        if ($order != 'id') {
            $list               = KycDocumentType::skip($start)->take($limit)->orderBy($order, $dir)
                ->search($search)
                ->get();
        } else {
            $list               = KycDocumentType::skip($start)->take($limit)->Latests()
                ->search($search)
                ->get();
        }
        // $query = DB::getQueryLog();
        if (empty($request->input('search.value'))) {
            $total_filtered = KycDocumentType::count();
        } else {
            $total_filtered = KycDocumentType::search($search)
                ->count();
        }

        $data           = array();
        if ($list) {
            $i = 1;
            foreach ($list as $document_types) {
                $document_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'document-types\',' . $document_types->id . ', 1)"> Inactive </div>';
                if ($document_types->status == 1) {
                    $document_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'document-types\',' . $document_types->id . ', 0)"> Active </div>';
                }
                $action = '
                <a href="javascript:void(0);" class="action-icon" onclick="return view_modal(\'document-types\', ' . $document_types->id . ')"> <i class="mdi mdi-eye"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'document-types\', ' . $document_types->id . ')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'document-types\', ' . $document_types->id . ')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data['document_name']       = $document_types->document_name;
                $nested_data['status']              = $document_status;
                $nested_data['action']              = $action;
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
        $modal_title = 'Add Country';
        if (isset($id) && !empty($id)) {
            $info = KycDocumentType::find($id);
            $modal_title = 'Update Country';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.customer_document_type.add_edit', $params);
      
    }

    public function view(Request $request)
    {
        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Document Type Info';
        $info = KycDocumentType::find($id);
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.customer_document_type.view', $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;

        if (isset($id) && !empty($id)) {
            $role_validator   = [
                'document_name'      => ['required', 'string', 'max:255', 'unique:kyc_document_types,document_name,' . $id],
            ];
        } else {
            $role_validator   = [
                'document_name'      => ['required', 'string', 'max:255', 'unique:kyc_document_types,document_name'],
            ];
        }
        //Validate the product
        $validator                     = Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {

            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['document_name'] = $request->document_name;

            if (isset($id) && !empty($id)) {
                $count = KycDocumentType::find($id);
                $count->status = isset($request->status) ? 1 : 0;
                $count->document_name = $request->document_name;
                $count->update();

                $success = 'Updated Document Types';
            } else {
                $ins['added_by'] = Auth::id();
                KycDocumentType::create($ins);
                $success = 'Added new Document Types';
            }
            return response()->json(['error' => [$success], 'status' => '0']);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = KycDocumentType::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error' => [$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $role = KycDocumentType::find($id);
        $role->status = $status;
        $role->update();
        $update_msg = 'Updated successfully';
        return response()->json(['error' => [$update_msg], 'status' => '0']);
    }
}
