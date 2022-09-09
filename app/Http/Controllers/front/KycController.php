<?php

namespace App\Http\Controllers\front;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerDocument;
use App\Models\KycDocumentType;
use App\Models\LandingPages;
use App\Repositories\CustomerRepository;
use Illuminate\Support\Facades\Validator;
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
        $documentTypes = $this->customerRepository->getDocumentTypes();
        $customerInfo = $this->customerRepository->getCustomerInfo($customer_id);
        $companyInfo = $this->customerRepository->getcompanyInfo($customer_id);
        $kycDocuments = $this->customerRepository->getKycDocumentDetails();
        $orderInfo = $this->customerRepository->getCustomerOrders();

        $activeMenu = 'kyc';
        return view('front.customer.index', compact('result', 'not_home', 'info', 'customerInfo', 'companyInfo', 'activeMenu', 'documentTypes', 'kycDocuments', 'orderInfo'));
    }

    public function kycSubmit(Request $request) 
    {

        $role_validator   = [
            'document_id' => ['required', 'max:255'],
        ];
        //Validate the product
        $validator                     = Validator::make($request->all(), $role_validator);

        if ($validator->passes()) {
            $document_ids = $request->document_id;
            
            if( isset($document_ids ) && !empty( $document_ids ) ) {
                foreach ($document_ids as $item) {
                    $file = '';
                    $customerDocumentId = $request->customerDocumentId_.$item;
                    $image_input_name           = 'file_'.$item;
                    if ($request->hasFile($image_input_name)) {
                        $store_path             = session('client')->id.'_'.$item;
                        $file                   = $request->file($image_input_name)->store('customer/kyc/'.$store_path, 'public');
        
                    }
                   
                    $ins = [];
                    $ins['customer_id']     = session('client')->id;
                    $ins['document_id']     = $item;
                    $ins['document']        = $file;
                    $ins['uploadAt']        = date('Y-m-d H:i:s');
                    $ins['status']          = 'pending';
                    $ins['rejectedAt']      = null;
                    $ins['rejectedBy']      = null;
                    $ins['reject_reason']   = null;
                    $ins['approvedAt']      = null;
                    $ins['approvedBy']      = null;

                    $doc_id = CustomerDocument::updateOrCreate(array('id' => $customerDocumentId ),$ins)->id;

                    CommonHelper::sendKycVerificationInternal($doc_id);
                    
                }
            }
            $kycDocuments = $this->customerRepository->getKycDocumentDetails();
            $success                = 'Kyc file Uploaded';

            return response()->json(['error' => [$success], 'status' => '0', 'kycDocuments' => $kycDocuments ]);

        }
        return response()->json(['error' => $validator->errors()->all(), 'status' => '1']);

       
    }
}
