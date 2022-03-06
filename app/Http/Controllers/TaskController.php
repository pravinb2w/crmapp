<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use CommonHelper;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Tasks', 'btn_fn_param' => 'tasks');
        return view('crm.tasks.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'task_name',  'assigned_to', 'created_at', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = Task::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = Task::whereRaw('created_at')->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = Task::whereRaw('created_at')->Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Task::count();
        } else {
            $total_filtered = Task::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $tasks ) {
                $tasks_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'tasks\','.$tasks->id.', 1)"> Inactive </div>';
                if( $tasks->status == 1 ) {
                    $tasks_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'tasks\','.$tasks->id.', 0)"> Active </div>';
                } else if( $tasks->status == 2) {
                    $tasks_status                     = '<div class="badge bg-primary" role="button" > Done </div>';

                }
                $action = '<a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'tasks\', '.$tasks->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'tasks\', '.$tasks->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$tasks->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'task_name' ]         = $tasks->task_name;
                $nested_data[ 'assigned_to' ]       = $tasks->assigned->name ?? '';
                $nested_data[ 'assigned_date' ]     = date('d-m-Y H:i A', strtotime($tasks->created_at ) ) ?? '';
                $nested_data[ 'status' ]            = $tasks_status;
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
        $from = $request->from;
        $modal_title = 'Add Tasks';
        $users = User::whereNotNull('role_id')->get();
        if( isset( $id ) && !empty($id) ) {
            $info = Task::find($id);
            $modal_title = 'Update Tasks';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'users' => $users, 'from' => $from];
        return view('crm.tasks.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

    public function save(Request $request)
    {
        $id = $request->id;
        $role_validator   = [
            'task_name'      => [ 'required', 'string', 'max:255'],
            'assigned_to'      => [ 'required', 'string', 'max:255'],
        ];
        
        //Validate the task
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {
            $ins['status']          = isset($request->status) ? 1 : 0;
            $ins['task_name']       = $request->task_name;
            $ins['assigned_to']     = $request->assigned_to;
            $ins['description']     = $request->description;
            
            if( isset($id) && !empty($id) ) {
                $page = Task::find($id);
                $page->status = isset($request->status) ? 1 : 0;
                $page->task_name = $request->task_name;
                $page->assigned_to = $request->assigned_to;
                $page->updated_by = Auth::id();
                $page->description = $request->description;
                $page->update();
                $success = 'Updated Task';
            } else {
                $ins['added_by'] = Auth::id();
                Task::create($ins);
                $success = 'Added new Task';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Task::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $page = Task::find($id);
        $page->status = $status;
        $page->update();
        $update_msg = 'Updated successfully';
        return response()->json(['error'=>[$update_msg], 'status' => '0']);
    }
}
