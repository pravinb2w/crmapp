<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use App\Models\Lead;
use App\Models\User;
use App\Models\Customer;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $params = array('btn_name' => 'Notes', 'btn_fn_param' => 'notes');
        return view('crm.note.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'notes', 'user_id', 'lead_id', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = Note::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = Note::skip($start)->take($limit)->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = Note::skip($start)->take($limit)->Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Note::count();
        } else {
            $total_filtered = Note::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $notes ) {

                $notes_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'notes\','.$notes->id.', 1)"> Inactive </div>';
                if( $notes->status == 1 ) {
                    $notes_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'notes\','.$notes->id.', 0)"> Active </div>';
                }
                $action = '
                <a href="javascript:void(0);" class="action-icon" onclick="return view_modal(\'notes\', '.$notes->id.')"> <i class="mdi mdi-eye"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'notes\', '.$notes->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'notes\', '.$notes->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$notes->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'notes' ]             = ucwords($notes->notes);
                $nested_data[ 'user' ]              = ucfirst($notes->user->name ?? '' );
                $nested_data[ 'lead' ]              = $notes->lead->lead_subject ?? $notes->lead->lead_description ?? '';
                $nested_data[ 'status' ]            = $notes_status;
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
        $modal_title = 'Add Note';
        if( isset( $id ) && !empty($id) ) {
            $info = Note::find($id);
            $modal_title = 'Update Note';
        }
        $users = User::whereNotNull('role_id')->get();
        
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'users' => $users, 'from' => $from];
        return view('crm.note.add_edit', $params);
       
    }

    public function view(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Note Info';
        $info = Note::find($id);
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.note.view', $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        
        $role_validator   = [
            'user_id'      => [ 'required', 'string', 'max:55'],
            'notes'      => [ 'required', 'string', 'max:555'],
        ];
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {

            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['lead_id'] = $request->lead_id ?? null;
            $ins['customer_id'] = $request->customer_id ?? null;
            $ins['user_id'] = $request->user_id;
            $ins['notes'] = $request->notes;

            if( isset($id) && !empty($id) ) {
                $act = Note::find($id);
                $act->status = isset($request->status) ? 1 : 0;
                $act->notes = $request->notes ?? null;
                $act->lead_id = $request->lead_id ?? null;
                $act->customer_id = $request->customer_id ?? null;
                $act->user_id = $request->user_id;
                $act->updated_by = Auth::id();
                $act->update();
                $success = 'Updated Activity';
            } else {
                $ins['added_by'] = Auth::id();
                Note::create($ins);
                $success = 'Added new Activity';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Note::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $role = Note::find($id);
        $role->status = $status;
        $role->update();
        $update_msg = 'Updated successfully';
        return response()->json(['error'=>[$update_msg], 'status' => '0']);
    }
}
