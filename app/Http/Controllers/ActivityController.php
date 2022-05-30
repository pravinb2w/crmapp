<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;
use App\Models\Lead;
use App\Models\User;
use App\Models\Customer;
use CommonHelper;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $params = array('btn_name' => 'Activity', 'btn_fn_param' => 'activities');
        return view('crm.activity.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'subject', 'activity_type', 'lead_id', 'customer_id', 'started_at', 'due_at','status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = Activity::roledata()->count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = Activity::roledata()->skip($start)->take($limit)->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = Activity::roledata()->skip($start)->take($limit)->Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Activity::roledata()->count();
        } else {
            $total_filtered = Activity::roledata()->search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $activities ) {
                if( empty($activities->done_at) ) {
                    $activities_done                        = '<div class="badge badge-warning-lighten" role="button" onclick="mark_as_done('.$activities->id.')"> Mark as done </div>';
                } else {
                    $activities_done                        = '<div class="badge badge-success-lighten" role="button"> Done '.date('d M Y H:i A', strtotime($activities->done_at ) ).'
                                                                </div>';
                }

                $activities_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'activities\','.$activities->id.', 1)"> Inactive </div>';
                if( $activities->status == 1 ) {
                    $activities_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'activities\','.$activities->id.', 0)"> Active </div>';
                }
                $action = '';
                if(Auth::user()->hasAccess('activities', 'is_view')) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return view_modal(\'activities\', '.$activities->id.')"> <i class="mdi mdi-eye"></i></a>';
                }
                if(Auth::user()->hasAccess('activities', 'is_edit')) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'activities\', '.$activities->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>';
                }
                if(Auth::user()->hasAccess('activities', 'is_delete')) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'activities\', '.$activities->id.')"> <i class="mdi mdi-delete"></i></a>';
                }

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$activities->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                // $nested_data[ 'subject' ]           = ucwords($activities->subject);
                $nested_data[ 'type' ]              = ucfirst($activities->activity_type);
                $nested_data[ 'lead' ]              = $activities->lead->lead_subject ?? $activities->lead->lead_description ?? $activities->deal->deal_title ?? '';
                $nested_data[ 'customer' ]          = $activities->customer->first_name ?? '';
                $nested_data[ 'startAt' ]           = date('d M Y H:i A', strtotime($activities->started_at ) );
                $nested_data[ 'dueAt' ]             = date('d M Y H:i A', strtotime($activities->due_at ) );
                $nested_data['done']                = $activities_done;
                $nested_data['assigned_to']         = $activities->user->name;
                $nested_data['assigned_by']         = $activities->added->name;
                $nested_data[ 'status' ]            = $activities_status;
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
        $modal_title = 'Add Activity';
        if( isset( $id ) && !empty($id) ) {
            $info = Activity::find($id);
            $modal_title = 'Update Activity';
        }
        $users = User::whereNotNull('role_id')->get();
        $customers = Customer::all();
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'users' => $users, 
                'customers' => $customers, 'from' => $from];
        return view('crm.activity.add_edit', $params);
        
    }

    public function view(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Acitivity Info';
        $info = Activity::find($id);
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.activity.view', $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        $role_validator   = [
            'activity_title'      => [ 'required', 'string', 'max:255'],
            'activity_type'      => [ 'required', 'string', 'max:255'],
            'start_date'      => [ 'required', 'string', 'max:255'],
            'start_time'      => [ 'required', 'string', 'max:255'],
            'due_time'      => [ 'required', 'string', 'max:255'],
            'due_date'      => [ 'required', 'string', 'max:255'],
        ];
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {
            $start_date = $request->start_date;
            $start_date = date('Y-m-d', strtotime($start_date));
            $start_date = $start_date.' '.$request->start_time.':00';
            $started_at = date('Y-m-d H:i:s', strtotime($start_date));


            $due_date = $request->due_date;
            $due_date = date('Y-m-d', strtotime($due_date));
            $due_date = $due_date.' '.$request->due_time.':00';
            $due_at = date('Y-m-d H:i:s', strtotime($due_date));
            
            $status = isset($request->status) ? 1 : 0;
            $ins['status'] = isset($request->status) ? $status : 1;
            $ins['subject'] = $request->activity_title;
            $ins['activity_type'] = $request->activity_type;
            $ins['notes'] = $request->notes ?? null;
            $ins['lead_id'] = $request->lead_id ?? null;
            $ins['deal_id'] = $request->deal_id ?? null;
            $ins['customer_id'] = $request->customer_id ?? null;
            $ins['started_at'] = $started_at;
            $ins['due_at'] = $due_at;
            $ins['user_id'] = $request->user_id;
            
            if( isset($id) && !empty($id) ) {
                $act = Activity::find($id);
                $act->status = isset($request->status) ? $status : 1;
                $act->subject = $request->activity_title;
                $act->activity_type = $request->activity_type;
                $act->notes = $request->notes ?? null;
                $act->lead_id = $request->lead_id ?? null;
                $act->deal_id = $request->deal_id ?? null;
                $act->customer_id = $request->customer_id ?? null;
                $act->started_at = $started_at;
                $act->due_at = $due_at;
                $act->user_id = $request->user_id;
                $act->updated_by = Auth::id();
                $act->update();
                $success = 'Updated Activity';
            } else {
                $ins['added_by'] = Auth::id();
                Activity::create($ins);
                $success = 'Added new Activity';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Activity::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        if(Auth::user()->hasAccess('notes', 'is_edit')) {
            $role = Activity::find($id);
            $role->status = $status;
            $role->update();
            $update_msg = 'Updated successfully';
            $status = '0';
        } else {
            $update_msg = 'You Do not have access to change status';
            $status = '1';
        }

        
        return response()->json(['error'=>$update_msg, 'status' => $status]);
    }

    public function mark_as_done(Request $request)
    {
        $id = $request->id;
        $type = $request->type;
        $lead_id = '';
        $deal_id = '';
        if( isset( $type ) && !empty($type)){
            $deal_id = $request->lead_id;
            CommonHelper::send_deal_activity_done_notification($id, $deal_id); 

        } else {
            $lead_id = $request->lead_id;
            CommonHelper::send_lead_activity_done_notification($id, $lead_id); 

        }
        if( !$request->lead_id ) {
            $page_type = 'activities';
        }
        $role = Activity::find($id);
        $role->done_by = Auth::id();
        $role->done_at = date('Y-m-d H:i:s');
        $role->update();
        $update_msg = 'Updated successfully';
        return response()->json(['error'=>[$update_msg], 'status' => '0',
                                'lead_id' => $lead_id, 'deal_id' => $deal_id, 'page_type' => $page_type ?? '' ]);
    }

    public function add_edit_modal(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $page_type = $request->page_type;
        $activity_id = $request->activity_id;
        $lead_id = $request->lead_id;
        $deal_id = $request->deal_id;

        $info = Activity::find($activity_id);
        $modal_title = 'Update Activity';
        $users = User::whereNotNull('role_id')->get();
        $customers = Customer::all();
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'users' => $users, 
                    'customers' => $customers, 'lead_id' => $lead_id, 'deal_id' => $deal_id, 'page_type' => $page_type ];
        return view('crm.activity.edit_modal', $params);
       
    }
}
