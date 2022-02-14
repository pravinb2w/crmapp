<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySettings;
use App\Models\Customer;
use App\Models\Lead;
use Illuminate\Support\Facades\Validator;

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
            $customer = Customer::where('email',$request->email)->first();

            if( isset($customer) && !empty($customer)) {
                $customer_id = $customer->id;
            } else {
                $ins['status'] = 1;
                $ins['first_name'] = $request->fullname;
                $ins['email'] = $request->email;
                $ins['added_by'] = 1;
                $customer_id = Customer::create($ins)->id;
            }
            $lea['customer_id'] = $customer_id;
            $lea['status'] = 1;
            $lea['added_by'] = 1;
            $lea['lead_subject'] = $request->subject;
            $lea['lead_description'] = $request->message;
            Lead::create($lea);
            $success = 'Enquiry has been sent';
            
        }
        return redirect('/')->with('status', $success);
        // return response()->json(['error'=>$validator->errors()->all(), 'status' => '1']);
    }
}
