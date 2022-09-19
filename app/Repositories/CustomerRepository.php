<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\CustomerDocument;
use App\Models\KycDocumentType;
use Illuminate\Support\Facades\Storage;

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
            'id' => $info->company->id ?? '',
            'name' => $info->company->name ?? '', 
            'email' => $info->company->email ?? '',
            'mobile_no' => $info->company->mobile_no ?? '',
            'address' => $info->company->address ?? '',
            'website' => $info->company->website ?? '',
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

    public function getCustomerOrders() {
        $info = Customer::find(session('client')->id);

        $orders = array(
                    'lastOrder' => array(),
                    'pendingApproval' => array(),
                    'rejectedInvoice' => array(),
                    'orderHistory' => array()
                );
        
        if( isset( $info->lastOrder ) && !empty( $info->lastOrder ) ) {

            $lorder[ 'date' ] = date( 'M d Y, h:i A', strtotime($info->lastOrder->created_at));
            $lorder[ 'orderNo' ] = $info->lastOrder->order_id ?? 'N/A';
            $lorder[ 'invoiceNo' ] = $info->lastOrder->invoice->invoice_no ?? 'N/a';
            $price = 0;
            $qty = 0;
            $product_name = '';
            if( isset( $info->lastOrder->invoice->items ) && $info->lastOrder->invoice->items ) {
                
                $name = [];
                foreach ( $info->lastOrder->invoice->items as $key => $value) {
                    $name[] = $value->product->product_name;
                    $price = $price + $value->amount;
                    $qty = $qty + $value->qty;
                }
                $product_name = implode(",", $name);

                $lorder[ 'payment_status' ] = ucfirst($info->lastOrder->payment->payment_status ?? '');
                $lorder[ 'order_status' ] = ucfirst($info->lastOrder->status);
                $invoice_no = str_replace("/", "_", $info->lastOrder->invoice->invoice_no );
                $lorder[ 'file' ] = Storage::url('public/invoice') . '/' . $invoice_no . '.pdf';

            }
            
            $lorder[ 'product' ] = $product_name;
            $lorder[ 'price' ] = $price;
            $lorder[ 'qty' ] = $qty;

            $orders['lastOrder'] = $lorder;

        }

        if( isset( $info->pendingApprovalInvoices ) && !empty( $info->pendingApprovalInvoices ) ) {
            $ptemp = [];
            foreach ( $info->pendingApprovalInvoices as $item ) {
                $pending = [];
                $pending['id'] = $item->id;
                $pending[ 'date' ] = date( 'M d Y, h:i A', strtotime($item->created_at));
                $pending[ 'invoiceNo' ] = $item->invoice_no ?? 'N/a';
                if( isset( $item->items ) && $item->items ) {
                    $price = 0;
                    $qty = 0;
                    $product_name = '';
                    $name = [];
                    foreach ( $item->items as $key => $value) {
                        $name[] = $value->product->product_name;
                        $price = $price + $value->amount;
                        $qty = $qty + $value->qty;
                    }
                    $product_name = implode(",", $name);

                }
                
                $pending[ 'product' ] = $product_name;
                $pending[ 'price' ] = $price;
                $pending[ 'qty' ] = $qty;
                $pending[ 'status' ] = $item->status;
                $invoice_no = str_replace("/", "_", $item->invoice_no );
                $pending[ 'file' ] = Storage::url('public/invoice') . '/' . $invoice_no . '.pdf';
                $ptemp[] = $pending;
            }
            $orders['pendingApproval'] = $ptemp;
        }

        if( isset( $info->rejectedInvoices ) && !empty( $info->rejectedInvoices ) ) {
            $ptemp = [];
            foreach ( $info->rejectedInvoices as $item ) {
                $pending = [];
                $pending[ 'date' ] = date( 'M d Y, h:i A', strtotime($item->created_at));
                $pending[ 'invoiceNo' ] = $item->invoice_no ?? 'N/a';

                $price = 0;
                $qty = 0;
                $product_name = '';
                $name = [];

                if( isset( $item->items ) && $item->items ) {
                    
                    foreach ( $item->items as $key => $value) {
                        $name[] = $value->product->product_name;
                        $price = $price + $value->amount;
                        $qty = $qty + $value->qty;
                    }
                    $product_name = implode(",", $name);

                    $pending[ 'product' ] = $product_name;
                    $pending[ 'price' ] = $price;
                    $pending[ 'qty' ] = $qty;
                    $pending[ 'reject_reason' ] = $item->reject_reason;
                    $pending[ 'status' ] = $item->status;
                    $invoice_no = str_replace("/", "_", $item->invoice_no );
                    $pending[ 'file' ] = Storage::url('public/invoice') . '/' . $invoice_no . '.pdf';
                }
                
               
                $ptemp[] = $pending;
            }
            $orders['rejectedInvoice'] = $ptemp;
        }

        if( isset( $info->orders ) && !empty( $info->orders ) ) {
            foreach ($info->orders as $order ) {
                $lorder = [];
                $lorder[ 'date' ] = date( 'M d Y, h:i A', strtotime($order->created_at));
                $lorder[ 'orderNo' ] = $order->order_id ?? 'N/A';
                $lorder[ 'invoiceNo' ] = $order->invoice->invoice_no ?? 'N/a';
                if( isset( $order->invoice->items ) && $order->invoice->items ) {
                    $price = 0;
                    $qty = 0;
                    $product_name = '';
                    $name = [];
                    foreach ( $order->invoice->items as $key => $value) {
                        $name[] = $value->product->product_name;
                        $price = $price + $value->amount;
                        $qty = $qty + $value->qty;
                    }
                    $product_name = implode(",", $name);
                    $lorder[ 'product' ] = $product_name;
                    $lorder[ 'price' ] = $price;
                    $lorder[ 'qty' ] = $qty;
                    $lorder[ 'payment_status' ] = ucfirst($order->payment->payment_status);
                    $lorder[ 'order_status' ] = ucfirst($order->status);
                    $invoice_no = str_replace("/", "_", $order->invoice->invoice_no );
                    $lorder[ 'file' ] = Storage::url('public/invoice') . '/' . $invoice_no . '.pdf';
                }
               

                $orders['orderHistory'][] = $lorder;
            }
            
        }
        return json_encode( $orders );
    }
    
}
