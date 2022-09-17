<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use CommonHelper;
use App\Models\Task;
use App\Models\Status;
use App\Models\TaskComment;
use App\Models\User;

class TaskController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Tasks', 'btn_fn_param' => 'tasks');
        return view('crm.tasks.index', $params);
    }

    public function ajax_list(Request $request)
    {

        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = ['task_name',  'assigned_to', 'assigned_to', 'created_at', 'end_date', 'status', 'status', 'id'];

        $limit              = $request->input('length');
        $start              = $request->input('start');
        $order              = $columns[intval($request->input('order')[0]['column'])];
        $dir                = $request->input('order')[0]['dir'];
        $search             = $request->input('search.value');

        $total_list         = Task::roledata()->count();
        // DB::enableQueryLog();

        if ($order != 'id') {
            $list               = Task::roledata()->skip($start)->take($limit)->orderBy($order, $dir)
                ->search($search)
                ->get();
        } else {
            $list               = Task::roledata()->skip($start)->take($limit)->Latests()
                ->search($search)
                ->get();
        }
        // $query = DB::getQueryLog();
        if (empty($request->input('search.value'))) {
            $total_filtered = Task::roledata()->count();
        } else {
            $total_filtered = Task::roledata()->search($search)
                ->count();
        }

        $data           = array();
        if ($list) {
            $i = 1;
            foreach ($list as $tasks) {

                $all_status = '<select class="status-dropdown" name="status_id" id="status_id" onchange="return change_act_status(' . $tasks->id . ', this.value)">';
                $all_status .= '<option value="">--select--</option>';
                $all_status_info = Status::where(['is_active' => 1, 'type' => 'task'])
                    ->orderBy('order', 'asc')->get();
                if (isset($all_status_info) && !empty($all_status_info)) {
                    foreach ($all_status_info as $stat) {
                        $selected = '';
                        if (isset($tasks->status_id) && $tasks->status_id == $stat->id) {
                            $selected = 'selected';
                        }
                        $all_status .= '<option value="' . $stat->id . '" ' . $selected . ' >' . $stat->status_name . '</option>';
                    }
                }
                $all_status .= '</select>';

                $comp = '&emsp;<span class="badge bg-warning" role="button" onclick="return complete_task(' . $tasks->id . ')"> Click To Complete</span>';

                $tasks_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'tasks\',' . $tasks->id . ', 1)"> Inactive </div>';
                if ($tasks->status == 1) {
                    $tasks_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'tasks\',' . $tasks->id . ', 0)"> Active </div>';
                } else if ($tasks->status == 2) {
                    $tasks_status                     = '<div class="badge bg-primary" role="button" > Completed </div>';
                    $comp = '';
                }
                $action = '';
                if (Auth::user()->hasAccess('tasks', 'is_view')) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return view_modal(\'tasks\', ' . $tasks->id . ')"> <i class="mdi mdi-eye"></i></a>';
                }
                if (Auth::user()->hasAccess('tasks', 'is_edit')) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'tasks\', ' . $tasks->id . ')"> <i class="mdi mdi-square-edit-outline"></i></a>';
                }
                if (Auth::user()->hasAccess('tasks', 'is_delete')) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'tasks\', ' . $tasks->id . ')"> <i class="mdi mdi-delete"></i></a>';
                }


                $due_color = $tasks->statusAll->color ?? '';
                $time = date('Y-m-d');
                $time = strtotime($time);
                $due_at = strtotime($tasks->end_date);
                if ($due_at < $time) {
                    $due_color = 'red';
                }


                $nested_data['task_name']         = '<div style="color:' . $due_color . '">' . $tasks->task_name . '</div>';
                $nested_data['assigned_to']       = '<div style="color:' . $due_color . '">' . ($tasks->assigned->name ?? '') . '</div>';
                $nested_data['assigned_by']       = '<div style="color:' . $due_color . '">' . ($tasks->added->name ?? '' . '</div>');
                // $nested_data[ 'assigned_date' ]     = (date('d-m-Y H:i A', strtotime($tasks->created_at ) ) ?? '' ).' '.$comp;
                $nested_data['assigned_date']     = '<div style="color:' . $due_color . '">' . (date('d-m-Y H:i A', strtotime($tasks->created_at)) ?? '') . '</div>';
                $nested_data['due_date']          = '<div style="color:' . $due_color . '">' . (date('d-m-Y', strtotime($tasks->end_date)) ?? '') . '</div>';
                $nested_data['progress_status']   = '<div style="color:' . $due_color . '">' . $all_status . '</div>';
                $nested_data['status']            = '<div style="color:' . $due_color . '">' . $tasks_status . '</div>';
                $nested_data['action']            = '<div style="color:' . $due_color . '">' . $action . '</div>';
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
        $modal_title = 'Add Tasks';
        $users = User::whereNotNull('role_id')->get();
        if (isset($id) && !empty($id)) {
            $info = Task::find($id);
            $modal_title = 'Update Tasks';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'users' => $users, 'from' => $from];
        return view('crm.tasks.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

    public function view(Request $request)
    {
        if (!$request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Task Info';
        $info = Task::find($id);
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.tasks.view', $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        if (Auth::user()->hasAccess('tasks', 'is_assign')) {
            $role_validator   = [
                'task_name'      => ['required', 'string', 'max:255'],
                'assigned_to'      => ['required', 'string', 'max:255'],
                'end_date' => ['required']
            ];
        } else {
            $role_validator   = [
                'task_name'      => ['required', 'string', 'max:255'],
                'end_date' => ['required']
            ];
        }
        //Validate the task
        $validator                     = Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {
            $ins['status']          = isset($request->status) ? 1 : 0;
            $ins['task_name']       = $request->task_name;
            $ins['assigned_to']     = $request->assigned_to ?? Auth::id();
            $ins['description']     = $request->description;
            $ins['end_date']        = date('Y-m-d', strtotime($request->end_date));

            if (isset($id) && !empty($id)) {
                $page = Task::find($id);
                $page->status = isset($request->status) ? 1 : 0;
                $page->task_name = $request->task_name;
                $page->assigned_to = $request->assigned_to ?? Auth::id();
                $page->updated_by = Auth::id();
                $page->description = $request->description;
                $page->end_date = date('Y-m-d', strtotime($request->end_date));
                $page->update();
                $success = 'Updated Task';
            } else {
                $ins['added_by'] = Auth::id();
                Task::create($ins);
                $success = 'Added new Task';
            }
            return response()->json(['error' => [$success], 'status' => '0']);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Task::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error' => [$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->task_id;
        $status_id = $request->status_id;
        if (Auth::user()->hasAccess('tasks', 'is_edit')) {

            $page = Task::find($id);
            $page->status_id = $status_id;
            $page->update();
            $update_msg = 'Updated successfully';
            $status = '0';
        } else {
            $update_msg = 'You Do not have access to change status';
            $status = '1';
        }
        return response()->json(['error' => $update_msg, 'status' => $status]);
    }

    public function complete_task(Request $request)
    {
        $id = $request->id;
        $status = 2;
        if (Auth::user()->hasAccess('tasks', 'is_edit')) {

            $page = Task::find($id);
            $page->status = $status;
            $page->update();
            $update_msg = 'Updated successfully';
            $status = '0';
        } else {
            $update_msg = 'You Do not have access to change status';
            $status = '1';
        }
        return response()->json(['error' => $update_msg, 'status' => $status]);
    }

    public function comment_save(Request $request)
    {
        $comment = $request->comment;

        $ins['comments'] = $comment;
        $ins['added_by'] = Auth::id();
        $ins['task_id'] = $request->task_id;

        TaskComment::create($ins);
        $params = array('task_id' => $request->task_id, 'status' => '1');
        return response()->json($params);
    }
    public function comment_list(Request $request)
    {
        $comment_list = TaskComment::where('task_id', $request->task_id)->orderBy('id', 'desc')->get();
        return view('crm.tasks.comment_list', compact('comment_list'));
    }
}