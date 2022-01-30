<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Models\User;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // dd('tested');
        return view('crm.account.account_index');
    }

    public function get_settings_tab(Request $request)
    {
        $type = $request->type;
        $id = Auth::id();
        $info = User::find($id);
        $params = ['type' => $type, 'info' => $info];
        $view = 'crm.account._account_'.$type;
        return view($view, $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;
        $type = $request->type;

        if( $type == 'profile' ) {
            $validator   = [
                'first_name'      => [ 'required', 'string', 'max:255' ],
                'email'      => [ 'required', 'string', 'max:255' ],
                'mobile_no'      => [ 'required', 'string', 'max:255' ],
                'profile_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg']
            ];
        }
        //Validate the product
        $validator                     = Validator::make( $request->all(), $validator );
        
        if ($validator->passes()) {
            $id = Auth::id();
            $user = User::find($id);
            $user->name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->mobile_no = $request->mobile_no;
            if( $request->hasFile( 'profile_image' ) ) {
                $file                       = $request->file( 'profile_image' )->store( 'account', 'public' );
                $user->image                  = $file;
            }
            $user->save();
            $success = 'Account settings saved';
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }
}
