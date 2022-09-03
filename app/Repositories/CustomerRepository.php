<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\CustomerDocument;
use App\Models\KycDocumentType;

class CustomerRepository
{
   public function getCustomerInfo( $id ) {

        $info = Customer::find( $id );
        $secondaryEmailData = array(
            array('email' => '', 'delete' => false, 'emailClass' => 'is-invalid form-control'),
            array('email' => '', 'delete' => false, 'emailClass' => 'is-invalid form-control')
        );
        $secondaryMobileData = array(
            array('phoneNumber' => '', 'delete' => false),
            array('phoneNumber' => '', 'delete' => false)
        );
        $response = [
                    'first_name' => '', 
                    'last_name' => '', 
                    'email' => '', 
                    'mobile_no' => '', 
                    'address' => '',
                    'secondaryEmailData' => $secondaryEmailData,
                    'secondaryMobileData' => $secondaryMobileData,
                ];
        
        $email = [];
        $mobile = [];

        if( isset( $info ) && !empty( $info ) ) {
            $response['first_name'] = $info->first_name;
            $response['last_name'] = $info->last_name;
            $response['email'] = $info->email;
            $response['mobile_no'] = $info->mobile_no;            
            $response['address'] = $info->address;
            if( isset( $info->secondary_email) && !empty( $info->secondary_email ) ) {
                foreach ($info->secondary_email as $item) {
                    $tmp['email'] = $item->email;
                    $tmp['delete'] = false;
                    $tmp['emailClass'] = 'is-valid form-control';
                    $email[] = $tmp;
                }
                $secondaryEmailData = $email;
            }
            if( isset( $info->secondary_mobile) && !empty( $info->secondary_mobile ) ) {
                foreach ($info->secondary_mobile as $item) {
                    $ktmp['phoneNumber'] = $item->mobile_no;
                    $ktmp['delete'] = false;
                    $mobile[] = $ktmp;
                }
                $secondaryMobileData = $mobile;

            }
            $response['secondaryEmailData'] = $secondaryEmailData;
            $response['secondaryMobileData'] = $secondaryMobileData;
        }

        return json_encode( array($response) );
    }

    public function getCompanyInfo($customer_id) {
        $info = Customer::find( $customer_id );
        // dd( $info->company );
        $links =  array(
            'facebook_url' => '',
            'twitter_url' => '',
            'instagram_url' => '',
            'linkedin_url' => '',
            'skype_url' => '',
            'github_url' => '',
        );
        if( isset( $info->company->links ) && !empty( $info->company->links ) ){
          
            $links['facebook_url'] = $info->company->links->facebook_url;
            $links['twitter_url'] = $info->company->links->twitter_url;
            $links['instagram_url'] = $info->company->links->instagram_url;
            $links['linkedin_url'] = $info->company->links->linkedin_url;
            $links['skype_url'] = $info->company->links->skype_url;
            $links['github_url'] = $info->company->links->github_url;
        }

        $response = array(
            'id' => $info->company->id,
            'name' => $info->company->name, 
            'email' => $info->company->email,
            'mobile_no' => $info->company->mobile_no,
            'address' => $info->company->address,
            'website' => $info->company->website,
            'links' => $links,

        );

        return json_encode( array( $response ));
    }

    public function getDocumentTypes() {
        $all = KycDocumentType::where('status', 1)->get();
        $links = [];
        if( isset( $all ) && !empty( $all ) ){

            foreach ($all as $item) {
                $tmp = [];
                $tmp['id'] = $item->id;
                $tmp['type'] = $item->document_name;
                $links[] = $tmp;
            }
          
        }

        return json_encode( $links);
    }

    public function getKycDocumentDetails() 
    {
        $all = CustomerDocument::where('customer_id', session('client')->id )->get();
        $result = [];
        $tmp = ['document' => '', 'document_type' => '', 'image_url' => '', 'document_id' => '', 'customerDocumentId' => '', 'document_status' => ''];

        if( isset( $all ) && !empty( $all ) ) {
            foreach ($all as $key => $value) {
                $tmp = ['document' => '', 'document_type' => '', 'image_url' => '', 'document_id' => '', 'customerDocumentId' => '', 'document_status' => ''];
                $tmp['document_type'] = $value->documentType->document_name;
                $tmp['image_url'] = asset('storage').'/'.$value->document; 
                $tmp['document_id'] = $value->document_id; 
                $tmp['customerDocumentId'] = $value->id; 
                $tmp['document_status'] = $value->status; 
                $tmp['reject_reason'] = $value->reject_reason; 
                $result[] = $tmp;
            }
        } else {
            $result[] = $tmp;
        }
        return json_encode( $result );
    }
    
}
