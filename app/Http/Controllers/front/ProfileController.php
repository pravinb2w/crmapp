<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerEmail;
use App\Models\CustomerMobile;
use App\Models\LandingPages;
use App\Repositories\CustomerRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private CustomerRepository $customerRepository;
    public function __construct( CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index(Request $request) {
        
        $result = LandingPages::where('is_default_landing_page', 1)->first();
    
        if (!$result) {
            $result   = LandingPages::latest()->first();
        }
        $not_home = 'auth';
        $customer_id = session('client')->id;
        $info = Customer::find( $customer_id );
        $customerInfo = $this->customerRepository->getCustomerInfo($customer_id);
        $companyInfo = $this->customerRepository->getcompanyInfo($customer_id);
        return view('front.customer.index', compact('result', 'not_home', 'info', 'customerInfo', 'companyInfo'));

    }

    public function save_customer(Request $request)
    {
        
        $role_validator   = [
            'first_name' => ['required', 'string', 'max:255'],
        ];
        //Validate the product
        $validator                     = Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {
            $customer_id = session('client')->id;

            $sett = Customer::find($customer_id);
            $sett->first_name = $request->first_name;
            $sett->last_name = $request->last_name;
            $sett->address = $request->address;
            $sett->update();
            $success = 'Updated Success';

            //insert in customer mobile and emails
            CustomerMobile::where('customer_id', $customer_id)->forceDelete();
            CustomerEmail::where('customer_id', $customer_id)->forceDelete();

            $secondary_phone = $request->secondary_phone;
            if (isset($secondary_phone) && !empty($secondary_phone)) {
                foreach ($secondary_phone as $value) {
                    if (!empty($value)) {
                        $cust['mobile_no'] = $value;
                        $cust['customer_id'] = $customer_id;
                        $cust['description'] = 'customer added';
                        $cust['status'] = 1;
                        CustomerMobile::create($cust);
                    }
                }
            }
            $secondary_email = $request->secondary_email;
            if (isset($secondary_email) && !empty($secondary_email)) {
                foreach ($secondary_email as $value) {
                    if (!empty($value)) {
                        $cust1['email'] = $value;
                        $cust1['customer_id'] = $customer_id;
                        $cust1['description'] = 'customer added';
                        $cust1['status'] = 1;
                        CustomerEmail::create($cust1);
                    }
                }
            }

            return response()->json(['error' => [$success], 'status' => '0']);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }

    public function change_profile_picture(Request $request)
    {
        $validator                      = [
                                            'profile_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg']
                                        ];
        $validator                      = Validator::make($request->all(), $validator);
        if ($validator->passes()) {

            $customer_id                = session('client')->id;
            $info                       = Customer::find( $customer_id );

            if ($request->hasFile('image')) {
                $file                   = $request->file('image')->store('customer/profile', 'public');
                $info->logo             = $file;

                $info->update();
                $success                = 'Profile Picture Updated';
                return response()->json(['error' => [$success], 'status' => '0']);
            }
        } 

        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);

    }

    public function remove_profile_picture() {

        $customer_id                = session('client')->id;
        $info                       = Customer::find( $customer_id );
        $info->logo = null;
        $info->update();
        $success                = 'Profile Picture Removed';
        return response()->json(['error' => [$success], 'status' => '0']);

    }
}
