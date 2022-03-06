<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Lead;
use App\Models\Deal;
use App\Models\User;
use App\Models\Customer;
use App\Models\LeadSource;
use App\Models\LeadType;
use App\Models\Note;
use App\Models\Activity;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $params = array('btn_name' => 'Lead', 'btn_fn_param' => 'leads');
        return view('crm.lead.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'lead_title', 'lead_type_id', 'lead_source_id', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = lead::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = lead::orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = lead::Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = lead::count();
        } else {
            $total_filtered = lead::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $leads ) {
                $leads_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'leads\','.$leads->id.', 1)"> Inactive </div>';
                if( $leads->status == 1 ) {
                    $leads_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'leads\','.$leads->id.', 0)"> Active </div>';
                } else if( $leads->status == 2 ) {
                    $leads_status                     = '<div class="badge bg-success" role="button" > Converted To Deal </div>';

                }
                $action = '<a href="'.route('leads.view',['id' => $leads->id]).'" class="action-icon"> <i class="mdi mdi-eye"></i></a>';
                if( $leads->status != 2 ) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'leads\', '.$leads->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>';
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'leads\', '.$leads->id.')"> <i class="mdi mdi-delete"></i></a>';
                }

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$leads->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'title' ]             = $leads->lead_title ?? $leads->lead_subject;
                $nested_data[ 'type' ]              = $leads->leadType->type ?? 'N/A';
                $nested_data[ 'source' ]            = $leads->leadSource->source ?? 'N/A';
                $nested_data[ 'created_at' ]        = date('d-m-Y', strtotime($leads->created_at ) );
                $nested_data[ 'status' ]            = $leads_status;
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

    public function view(Request $request, $id = '') {
        $users = User::whereNotNull('role_id')->get();
        $info = Lead::with(['planned_activity','done_activity'])->find($id);
        $all_done = ( isset($info->planned_activity) && count( $info->planned_activity ) > 0 ) ? 'no':'yes' ;
        return view('crm.lead.view', ['users' => $users, 'id' => $id, 'info' => $info, 'all_done' => $all_done ]);
    }

    public function autocomplete_lead_deal(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $query              = $request->org;
        $list               = Lead::search( $query )
                                ->get();

        $dlist              = Deal::search( $query )
                                ->get();
        $data = [];
        if( isset($list) && !empty($list) ) {
            foreach($list as $list){
                $tmp['type'] = 'lead';
                $tmp['id'] = $list->id;
                $tmp['name'] = $list->lead_title ?? $list->lead_subject;
                $data[] = $tmp;
            }
        }

        if( isset($dlist) && !empty($dlist) ) {
            foreach($dlist as $dlist){
                $tmp['type'] = 'deal';
                $tmp['id'] = $dlist->id;
                $tmp['name'] = $dlist->deal_title;
                $data[] = $tmp;
            }
        }
        $params['list']     = $data;
        $params['query']    = $query;
        return view('crm.common._autocomplete_lead_deal', $params);
    }

    public function autocomplete_lead_deal_set(Request $request){
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id  = $_POST['id'];
        $query = $_POST['query'] ?? '';
        $type = $_POST['lead_type'];

        if( isset($type) && $type == 'lead') {
            $info = Lead::find($id);
        } else if( isset($type) && $type == 'deal') {
            $info = Deal::find($id);
        }

        $params['name'] = $info->lead_title ?? $info->lead_subject ?? $info->deal_title;
        $params['id'] = $id;
        $params['type'] = $type;
        $params['customer'] = $info->customer->first_name;
        $params['customer_id'] = $info->customer_id;

        return response()->json($params);
    }

    public function activity_save(Request $request) {
        $id = $request->id;
        
        $role_validator   = [
            'activity_title'      => [ 'required', 'string', 'max:255'],
            'activity_type'      => [ 'required', 'string', 'max:255'],
            'start_date'      => [ 'required', 'string', 'max:255'],
            'start_time'      => [ 'required', 'string', 'max:255'],
            'due_time'      => [ 'required', 'string', 'max:255'],
            'due_date'      => [ 'required', 'string', 'max:255'],
            'lead_id'      => [ 'required', 'string', 'max:255'],
        ];
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {
            $lead_id  = $request->lead_id;
            $lead_info = Lead::find($lead_id);
            $deal_id  = $request->deal_id;
            $deal_info = Deal::find($deal_id);

            $start_date = $request->start_date;
            $start_date = date('Y-m-d', strtotime($start_date));
            $start_date = $start_date.' '.$request->start_time.':00';
            $started_at = date('Y-m-d H:i:s', strtotime($start_date));

            $due_date = $request->due_date;
            $due_date = date('Y-m-d', strtotime($due_date));
            $due_date = $due_date.' '.$request->due_time.':00';
            $due_at = date('Y-m-d H:i:s', strtotime($due_date));

            $ins['status'] = 1;
            $ins['subject'] = $request->activity_title;
            $ins['activity_type'] = $request->activity_type;
            $ins['notes'] = $request->notes ?? null;
            $ins['lead_id'] = $request->lead_id ?? null;
            $ins['deal_id'] = $request->deal_id ?? null;
            $ins['customer_id'] = $lead_info->customer_id ?? $deal_info->customer_id ?? $request->customer_id ?? null;
            $ins['started_at'] = $started_at;
            $ins['due_at'] = $due_at;
            $ins['user_id'] = $request->user_id;
            
            if( isset($id) && !empty($id) ) {
                $act = Activity::find($id);
                $act->status = 1;
                $act->subject = $request->activity_title;
                $act->activity_type = $request->activity_type;
                $act->notes = $request->notes ?? null;
                $act->lead_id = $request->lead_id ?? null;
                $act->deal_id = $request->deal_id ?? null;
                $act->customer_id = $lead_info->customer_id ?? $deal_info->customer_id ?? $request->customer_id ?? null;
                $act->started_at = $started_at;
                $act->due_at = $due_at;
                $act->user_id = $request->user_id;
                $act->updated_by = Auth::id();
                $act->update();
            } else {
                $ins['added_by'] = Auth::id();
                Activity::create($ins);
                $success = 'Acitivity added successfully';
            }
            return response()->json(['error'=>[$success], 'status' => '0', 'lead_id' => $lead_id, 'type' => 'planned']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function refresh_timeline(Request $request) {
        $type = $request->type;
        $lead_id = $request->lead_id;

        $info = Lead::with(['planned_activity','done_activity', 'notes'])->find($lead_id);

        return view('crm.lead._'.$type.'_pane', ['info' => $info]);
    }

    public function delete_activity(Request $request)
    {
        $lead_id = $request->lead_id;
        $activity_id = $request->activity_id;
        $type = $request->type;

        $role = Activity::find($activity_id);
        $role->delete();
        return response()->json(['status' => '0', 'lead_id' => $lead_id, 'type' => $type]);
    }

    public function notes_save(Request $request) {
        $id = $request->id;
        
        $role_validator   = [
            'notes'      => [ 'required', 'string', 'max:255'],
            'lead_id'      => [ 'required', 'string', 'max:255'],
        ];
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {
            $lead_id  = $request->lead_id;
            $lead_info = Lead::find($lead_id);
            $notes = $request->notes;

            $ins['status'] = isset($request->status) ? $request->status: 1;
            $ins['notes'] = $request->notes ?? null;
            $ins['lead_id'] = $request->lead_id ?? null;
            $ins['customer_id'] = $lead_info->customer_id ?? null;
            $ins['user_id'] = Auth::id();

            if( isset($id) && !empty($id) ) {
                $act = Note::find($id);
                $act->status = isset($request->status) ? 1 : 0;
                $act->notes = $request->notes ?? null;
                $act->lead_id = $request->lead_id ?? null;
                $act->customer_id = $request->customer_id ?? null;
                $act->user_id = Auth::id();
                $act->updated_by = Auth::id();
                $act->update();
            } else {
                $ins['added_by'] = Auth::id();
                Note::create($ins);
                $success = 'Acitivity added successfully';
            }
            return response()->json(['error'=>[$success], 'status' => '0', 'lead_id' => $lead_id, 'type' => 'done']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function add_edit(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $from = $request->from;
        $modal_title = 'Add Lead';
        $leadsource = LeadSource::all();
        $leadtype = LeadType::all();
        $users = User::whereNotNull('role_id')->get();

        if( isset( $id ) && !empty($id) ) {
            $info = Lead::find($id);
            $modal_title = 'Update Lead';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'leadsource' => $leadsource ?? '', 
                    'leadtype' => $leadtype ?? '', 'users' => $users, 'from' => $from];
        return view('crm.lead.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

    public function save(Request $request)
    {
        $id = $request->id;
        
        $role_validator   = [
            'customer_id'      => [ 'required', 'string', 'max:255'],
            'organization_id'      => [ 'required', 'string', 'max:255'],
            'title'      => [ 'required', 'string', 'max:255'],
            'lead_type'      => [ 'required', 'string', 'max:255'],
            'lead_source'      => [ 'required', 'string', 'max:255'],
        ];
       
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {

            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['lead_subject'] = $request->title;
            $ins['customer_id'] = $request->customer_id;
            $ins['lead_type_id'] = $request->lead_type;
            $ins['lead_source_id'] = $request->lead_source;
            $ins['lead_value'] = $request->lead_value;
            if( $request->assigned_to ) {
                $ins['assinged_by'] = Auth::id();
                $ins['assigned_to'] = $request->assigned_to;
            }
            if( $request->organization_id ) {
                $cus = Customer::find($request->customer_id);
                $cus->organization_id = $request->organization_id;
                $cus->update();
            }
            if( isset($id) && !empty($id) ) {
                $lead = Lead::find($id);
                $lead->status = isset($request->status) ? 1 : 0;
                $lead->lead_subject = $request->title;
                $lead->customer_id = $request->customer_id;
                $lead->lead_type_id = $request->lead_type;
                $lead->lead_source_id = $request->lead_source;
                $lead->lead_value = $request->lead_value;
                if( $request->assigned_to ) {
                    $lead->assinged_by = Auth::id();
                    $lead->assigned_to = $request->assigned_to;
                }
                $lead->update();
                $success = 'Updated Lead';
            } else {
                $ins['added_by'] = Auth::id();
                Lead::create($ins);
                $success = 'Added new Lead';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Lead::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $ins['status'] = $status;
        $leadtype = Lead::find($id);
        $leadtype->status = $status;
        $leadtype->update();
        $update_msg = 'Updated successfully';
        return response()->json(['error'=>[$update_msg], 'status' => '0']);
    }

    public function mark_as_done(Request $request) {
        $lead_id = $request->lead_id;
        $updata['done_by'] = Auth::id();
        $updata['done_at'] = date('Y-m-d H:i:s');

        $role = Activity::where('lead_id', $lead_id )->update($updata);
       
        $update_msg = 'Updated successfully';
        return response()->json(['error'=>[$update_msg], 'status' => '0', 'lead_id' => $lead_id]);
    }
}
