<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerEmail;
use App\Models\CustomerMobile;
use App\Models\LandingPages;
use App\Models\Organization;
use App\Models\OrganizationLink;
use App\Repositories\CustomerRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $documentTypes = $this->customerRepository->getDocumentTypes();
        $kycDocuments = $this->customerRepository->getKycDocumentDetails();

        return view('front.customer.index', compact('result', 'not_home', 'info', 'customerInfo', 'companyInfo','documentTypes','kycDocuments'));

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

    public function save_company(Request $request)
    {
        $id = $request->id;
        $role_validator   = [
            'name' => ['required', 'string', 'max:255'],
            'email'      => ['nullable', 'string', 'max:255', 'unique:organizations,email,' . $id],
            'mobile_no'      => ['nullable', 'digits:10', 'max:255', 'unique:organizations,mobile_no,' . $id],
        ];
        //Validate the product
        $validator                     = Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {
            $customer_id = session('client')->id;
           
            $company_info = Organization::where('name', $request->name)->first();
            if( isset( $company_info ) && !empty( $company_info ) ) {
                $company_id = $company_info->id;
                $company_info->email = $request->email;
                $company_info->mobile_no = $request->mobile_no;
                $company_info->website = $request->website;
                $company_info->address = $request->address;
                $company_info->update();

                $links = OrganizationLink::where('company_id', $company_id)->first();
                if( isset($links) && !empty( $links) ){
                    $links->facebook_url= $request->facebook_url;
                    $links->twitter_url= $request->twitter_url;
                    $links->instagram_url= $request->instagram_url;
                    $links->linkedin_url= $request->linkedin_url;
                    $links->skype_url= $request->skype_url;
                    $links->github_url= $request->github_url;
                    $links->update();
                } else {
                    $link_ins['company_id']= $company_id;
                    $link_ins['facebook_url']= $request->facebook_url;
                    $link_ins['twitter_url']= $request->twitter_url;
                    $link_ins['instagram_url']= $request->instagram_url;
                    $link_ins['linkedin_url']= $request->linkedin_url;
                    $link_ins['skype_url']= $request->skype_url;
                    $link_ins['github_url']= $request->github_url;
                    OrganizationLink::create($link_ins);
                }
                

            } else {
                $ins_company['name'] = $request->name;
                $ins_company['email'] = $request->email;
                $ins_company['mobile_no'] = $request->mobile_no;
                $ins_company['address'] = $request->address;
                $ins_company['website'] = $request->website;

                $company_id = Organization::create($ins_company)->id;

                $ins_links['company_id'] = $company_id;
                $ins_links['facebook_url'] = $request->facebook_url;
                $ins_links['twitter_url'] = $request->twitter_url;
                $ins_links['instagram_url'] = $request->instagram_url;
                $ins_links['linkedin_url'] = $request->linkedin_url;
                $ins_links['skype_url'] = $request->skype_url;
                $ins_links['github_url'] = $request->github_url;

                OrganizationLink::create($ins_links);
            }

            $sett = Customer::find($customer_id);
            $sett->organization_id = $company_id;
            $sett->update();
            $success = 'Updated Success';

            return response()->json(['error' => [$success], 'status' => '0']);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }

    public function settings(Request $request) {
        
        $result = LandingPages::where('is_default_landing_page', 1)->first();
    
        if (!$result) {
            $result   = LandingPages::latest()->first();
        }
        $not_home = 'auth';
        $customer_id = session('client')->id;
        $info = Customer::find( $customer_id );
        $customerInfo = $this->customerRepository->getCustomerInfo($customer_id);
        $companyInfo = $this->customerRepository->getcompanyInfo($customer_id);
        $documentTypes = $this->customerRepository->getDocumentTypes();
        $kycDocuments = $this->customerRepository->getKycDocumentDetails();
        $activeMenu = 'settings';
        return view('front.customer.index', compact('result', 'not_home', 'info', 'customerInfo', 'companyInfo', 'activeMenu','documentTypes', 'kycDocuments'));

    }

    public function save_password(Request $request)
    {
        $id = $request->id;
        $role_validator   = [
            'password' => ['required', 'string', 'max:255'],
            'confirmPassword' => ['required', 'string', 'max:255'],
        ];
        //Validate the product
        $validator                     = Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {
            $customer_id = session('client')->id;
           
            $sett = Customer::find($customer_id);
            $sett->password = Hash::make($request->password);
            $sett->update();
            $success = 'Updated Success';

            return response()->json(['error' => [$success], 'status' => '0']);
        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);
    }
}
