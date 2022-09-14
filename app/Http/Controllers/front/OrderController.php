<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\LandingPages;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private CustomerRepository $customerRepository;
    public function __construct( CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    
    public function index( Request $request ) {
        $result = LandingPages::where('is_default_landing_page', 1)->first();
    
        if (!$result) {
            $result   = LandingPages::latest()->first();
        }
        $not_home = 'auth';
        $customer_id = session('client')->id;
        $info = Customer::find( $customer_id );
        $documentTypes = $this->customerRepository->getDocumentTypes();
        $customerInfo = $this->customerRepository->getCustomerInfo($customer_id);
        $companyInfo = $this->customerRepository->getcompanyInfo($customer_id);
        $kycDocuments = $this->customerRepository->getKycDocumentDetails();
        $orderInfo = $this->customerRepository->getCustomerOrders();
        $activeMenu = 'orders';
        return view('front.customer.index', compact('result', 'not_home', 'info', 'customerInfo', 'companyInfo', 'activeMenu', 'documentTypes', 'kycDocuments', 'orderInfo'));
    }

    public function rejectInvoice(Request $request)
    {
        $info = Invoice::find($request->id);
        $info->status = 2;
        $info->rejected_at = date('Y-m-d H:i:s');
        $info->reject_reason = $request->reason ?? '';
        $info->update();

        $orderInfo = $this->customerRepository->getCustomerOrders();
        $success = 'Invoice rejected successfully.';
        return response()->json(['orderInfo' => $orderInfo, 'status' => 0, 'error' => [$success]]);
    }
}
