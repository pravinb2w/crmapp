<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySettings;

class LandingController extends Controller
{
    public function index()
    {
        $info = CompanySettings::find(1);
        $params['info'] = $info;
        return view('landing.landing', $params);
    }

    public function enquiry_save(Request $request) {
        $id = $request->id;
        
        $role_validator   = [
            'fullname'      => [ 'required', 'string', 'max:255'],
            'email'      => [ 'required', 'string', 'max:255'],
            'subject'      => [ 'required', 'string', 'max:255'],
            'message'      => [ 'required', 'string', 'max:255'],

        ];
        //Validate the product
        $validator                     = Validator::make( $request->all(), $role_validator );
        
        if ($validator->passes()) {

            // $ins['status'] = isset($request->status) ? 1 : 0;
            // $ins['site_name'] = $request->company_name;
            // $ins['added_by'] = Auth::id();
            // CompanySettings::create($ins);
            // $success = 'Added new company';
        
            return response()->json(['error'=>[$success], 'status' => '0']);
        }
        return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }
}
