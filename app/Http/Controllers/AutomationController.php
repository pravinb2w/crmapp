<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Automation;
use App\Models\EmailTemplates;

class AutomationController extends Controller
{
    public function index(Request $request)
    {
        $params = array('btn_name' => 'Workflow Automation', 'btn_fn_param' => 'automation');
        return view('crm.automation.index', $params);
    }

    public function add_edit(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Add Workflow Automation';
        $workflow_type = config('constant.workflow_type');
        $template = EmailTemplates::select('id','title', 'subject')->get();
        // $company = CompanySettings::whereNotNull('created_at')->get();
        $info = '';
        if( isset( $id ) && !empty($id) ) {
            $info = Automation::find($id);
            $modal_title = 'Update Workflow Automation';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.automation.add_edit', compact('id','modal_title','workflow_type','info', 'template'));
       
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'activity_type',  'is_mail_to_customer', 'is_mail_to_team', 'is_notification_to_team','status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = Automation::roledata()->count();
        // DB::enableQueryLog();
        
        if( $order != 'id') {
            $list               = Automation::roledata()->skip($start)->take($limit)->orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = Automation::roledata()->skip($start)->take($limit)->Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Automation::roledata()->count();
        } else {
            $total_filtered = Automation::roledata()->search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $automation ) {

                $automation_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'automation\','.$automation->id.', 1)"> Inactive </div>';
                if( $automation->status == 1 ) {
                    $automation_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'automation\','.$automation->id.', 0)"> Active </div>';
                } else if( $automation->status == 2) {
                    $automation_status                     = '<div class="badge bg-primary" role="button" > Completed </div>';
                }
                $action = '';
                if(Auth::user()->hasAccess('automation', 'is_view')) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return view_modal(\'automation\', '.$automation->id.')"> <i class="mdi mdi-eye"></i></a>';
                }
                if(Auth::user()->hasAccess('automation', 'is_edit')) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'automation\', '.$automation->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>';
                }
                if(Auth::user()->hasAccess('automation', 'is_delete')) {
                    $action .= '<a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'automation\', '.$automation->id.')"> <i class="mdi mdi-delete"></i></a>';
                }

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$automation->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';


                $nested_data[ 'activity_type' ]         = $automation->activity_type;
                $nested_data[ 'is_mail_to_customer' ]       = ($automation->is_mail_to_customer == 1 ) ? 'Yes' : 'No';
                $nested_data[ 'is_mail_to_team' ]       = ($automation->is_mail_to_team == 1 ) ? 'Yes' : 'No';
                $nested_data[ 'is_notification_to_team' ]     = ($automation->is_notification_to_team == 1 ) ? 'Yes' : 'No';
                $nested_data[ 'status' ]            = $automation_status;
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

    public function save(Request $request)
    {
        $id = $request->id;
        $role_validator   = [
            'activity_type'      => [ 'required', 'string', 'max:255', 'unique:automations,activity_type,'.$id],
            'customer_template_id'      => [ 'required_with:is_mail_to_customer', 'max:255'],
            'team_template_id'      => [ 'required_with:is_mail_to_team', 'max:255'],
            'notification_title'      => [ 'required_with:is_notification_to_team', 'max:255'],
            'notification_message'      => [ 'required_with:is_notification_to_team', 'max:255'],
        ];
        
        //Validate the task
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {
            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['activity_type'] = $request->activity_type;
            $ins['template_id'] = $request->customer_template_id ?? null;
            $ins['is_mail_to_customer'] = isset($request->is_mail_to_customer) ? 1 : 0;
            $ins['is_mail_to_team'] = isset($request->is_mail_to_team) ? 1 : 0;
            $ins['is_notification_to_team']  = isset($request->is_notification_to_team) ? 1 : 0;
            $ins['notification_title'] = $request->notification_title;
            $ins['notification_message'] = $request->notification_message;
            $ins['team_template_id'] = $request->team_template_id ?? null;
            
            if( isset($id) && !empty($id) ) {
                $flow = Automation::find($id);
                $flow->status = isset($request->status) ? 1 : 0;
                $flow->activity_type = $request->activity_type;
                $flow->template_id = $request->customer_template_id ?? null;
                $flow->is_mail_to_customer = isset($request->is_mail_to_customer) ? 1 : 0;
                $flow->is_mail_to_team = isset($request->is_mail_to_team) ? 1 : 0;
                $flow->is_notification_to_team  = isset($request->is_notification_to_team) ? 1 : 0;
                $flow->notification_title = $request->notification_title;
                $flow->notification_message = $request->notification_message;
                $flow->team_template_id = $request->team_template_id ?? null;
                $flow->update();
                $success = 'Updated Workflow Automation';
            } else {
                $ins['added_by'] = Auth::id();
                Automation::create($ins);
                $success = 'Added new Workflow Automation';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Automation::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        if(Auth::user()->hasAccess('automation', 'is_edit')) {

            $page = Automation::find($id);
            $page->status = $status;
            $page->update();
            $update_msg = 'Updated successfully';
            $status = '0';
        } else {
            $update_msg = 'You Do not have access to change status';
            $status = '1';
        }
        return response()->json(['error'=> $update_msg, 'status' => $status]);
    }

    public function view(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Work Automation Info';
        $info = Automation::find($id);
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.automation.view', $params);
    }
}
