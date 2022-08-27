<?php

namespace App\Repositories;

use App\Models\Customer;

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

        $response = array(
            'name' => '', 
            'email' => '',
            'mobile_no' => '',
            'address' => '',
            'website' => '',
            'links' => $links,

        );

        return json_encode( array( $response ));
    }
}
