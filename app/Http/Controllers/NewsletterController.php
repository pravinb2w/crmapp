<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $params = array('btn_name' => 'News Letter', 'btn_fn_param' => '', 'is_add_exits' => 'no');
        return view('crm.newsletter.index', $params);
    }

    public function ajax_list(Request $request)
    {

        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = ['created_at', 'email', 'id'];

        $limit              = $request->input('length');
        $start              = $request->input('start');
        $order              = $columns[intval($request->input('order')[0]['column'])];
        $dir                = $request->input('order')[0]['dir'];
        $search             = $request->input('search.value');

        $total_list         = Newsletter::count();
        // DB::enableQueryLog();
        if ($order != 'id') {
            $list               = Newsletter::skip($start)->take($limit)->orderBy($order, $dir)
                ->search($search)
                ->get();
        } else {
            $list               = Newsletter::skip($start)->take($limit)->Latests()
                ->search($search)
                ->get();
        }
        // $query = DB::getQueryLog();
        if (empty($request->input('search.value'))) {
            $total_filtered = Newsletter::count();
        } else {
            $total_filtered = Newsletter::search($search)
                ->count();
        }

        $data           = array();
        if ($list) {
            $i = 1;
            foreach ($list as $notes) {

                $notes_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'notes\',' . $notes->id . ', 1)"> Inactive </div>';
                if ($notes->status == 1) {
                    $notes_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'notes\',' . $notes->id . ', 0)"> Active </div>';
                }
                $action = '';
              
                if (superadmin()) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'newsletter\', ' . $notes->id . ')"> <i class="mdi mdi-delete"></i></a>';
                }

                $nested_data['date']                = date('d M Y H:i A', strtotime($notes->created_at));
                $nested_data['email']               = ucfirst($notes->email ?? '');
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

    public function delete(Request $request)
    {
        $id = $request->id;
        $data = Newsletter::findOrFail($id);
        $data->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error' => [$delete_msg], 'status' => '0']);
    }
}
