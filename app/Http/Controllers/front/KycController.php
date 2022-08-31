<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\LandingPages;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class KycController extends Controller
{
    private CustomerRepository $customerRepository;
    public function __construct( CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    
    public function index(Request $request)
    {
        $result = LandingPages::where('is_default_landing_page', 1)->first();
    
        if (!$result) {
            $result   = LandingPages::latest()->first();
        }
        $not_home = 'auth';
        $customer_id = session('client')->id;
        $info = Customer::find( $customer_id );
        $customerInfo = $this->customerRepository->getCustomerInfo($customer_id);
        $companyInfo = $this->customerRepository->getcompanyInfo($customer_id);
        $activeMenu = 'kyc';
        return view('front.customer.index', compact('result', 'not_home', 'info', 'customerInfo', 'companyInfo', 'activeMenu'));
    }
}
