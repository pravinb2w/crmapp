<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;

class TeamController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Team', 'btn_fn_param' => 'teams');
        return view('crm.team.index', $params);
    }

    public function ajax_list( Request $request ) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }

        $columns            = [ 'id', 'team_name', 'team_limit', 'status', 'id' ];

        $limit              = $request->input( 'length' );
        $start              = $request->input( 'start' );
        $order              = $columns[ intval( $request->input( 'order' )[0][ 'column' ] ) ];        
        $dir                = $request->input( 'order' )[0][ 'dir' ];
        $search             = $request->input( 'search.value' );
       
        $total_list         = Team::count();
        // DB::enableQueryLog();
        if( $order != 'id') {
            $list               = Team::orderBy($order, $dir)
                                ->search( $search )
                                ->get();
        } else {
            $list               = Team::Latests()
                                ->search( $search )
                                ->get();
        }
        // $query = DB::getQueryLog();
        if( empty( $request->input( 'search.value' ) ) ) {
            $total_filtered = Team::count();
        } else {
            $total_filtered = Team::search( $search )
                                ->count();
        }
        
        $data           = array();
        if( $list ) {
            $i=1;
            foreach( $list as $teams ) {
                $teams_status                         = '<div class="badge bg-danger" role="button" onclick="change_status(\'teams\','.$teams->id.', 1)"> Inactive </div>';
                if( $teams->status == 1 ) {
                    $teams_status                     = '<div class="badge bg-success" role="button" onclick="change_status(\'teams\','.$teams->id.', 0)"> Active </div>';
                }
                $action = '<a href="javascript:void(0);" class="action-icon" onclick="return get_add_modal(\'teams\', '.$teams->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                <a href="javascript:void(0);" class="action-icon" onclick="return common_soft_delete(\'teams\', '.$teams->id.')"> <i class="mdi mdi-delete"></i></a>';

                $nested_data[ 'id' ]                = '<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck2" value="'.$teams->id.'">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>';
                $nested_data[ 'team_name' ]              = $teams->team_name;
                $nested_data[ 'team_limit' ]             = $teams->team_limit;
                $nested_data[ 'status' ]            = $teams_status;
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
        $modal_title = 'Add Team';

        if( isset( $id ) && !empty($id) ) {
            $info = Team::find($id);
            $modal_title = 'Update Team';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.team.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }

    public function save(Request $request)
    {
        $id = $request->id;
        
        
        if( isset( $id ) && !empty($id) ) {
            $role_validator   = [
                'team_name'      => [ 'required', 'string', 'max:255', 'unique:teams,team_name,'.$id ],
                'team_limit'      => [ 'required', 'string', 'max:255' ],

            ];
        } else {
            $role_validator   = [
                'team_name'      => [ 'required', 'string', 'max:255', 'unique:teams,team_name'],
                'team_limit'      => [ 'required', 'string', 'max:255'],
            ];
        }
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {

            $ins['status'] = isset($request->status) ? 1 : 0;
            $ins['team_name'] = $request->team_name;
            $ins['team_limit'] = $request->team_limit;
            $ins['description'] = $request->description;
            
            if( isset($id) && !empty($id) ) {
                Team::whereId($id)->update($ins);
                $success = 'Updated Team';
            } else {
                $ins['added_by'] = Auth::id();
                Team::create($ins);
                $success = 'Added new Team';
            }
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $role = Team::find($id);
        $role->delete();
        $delete_msg = 'Deleted successfully';
        return response()->json(['error'=>[$delete_msg], 'status' => '0']);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $ins['status'] = $status;
        Team::whereId($id)->update($ins);
        $update_msg = 'Updated successfully';
        return response()->json(['error'=>[$update_msg], 'status' => '0']);
    }
}
