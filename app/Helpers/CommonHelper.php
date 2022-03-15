<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\PrefixSetting;
use App\Models\CompanySettings;

class CommonHelper
{
    public static function getExpiry($period, $start_date)
    {
        $period = explode("-",$period);
        $day = $period[0];
        $start = date('Y-m-d', strtotime($start_date ) ); 
        if( strtolower($period[1]) == 'm' ) {
            return date('Y-m-d', strtotime( '+'.$day.' month', strtotime($start) ));
        } else if(  strtolower($period[1]) == 'y' ) {
            return date('Y-m-d', strtotime( '+'.$day.' year', strtotime($start) ));
        } else if(  strtolower($period[1]) == 'd' ) {
            return date('Y-m-d', strtotime( '+'.$day.' days', strtotime($start) ));
        }
    }

    public static function get_product_code() {
        $prefix = PrefixSetting::where('prefix_field', 'Product')->first();
        $prefix_value = $prefix->prefix_value;

        $exp = explode('/', $prefix_value );
        $str = $exp[0];
        $num = end($exp);
        array_pop($exp);
        $num = $num + 1;
        $length = '';
        if( strlen($num) < 4 ) {
            $length  = 4 - strlen($num);
            $length = str_repeat('0', $length);
        }
        $length = $length.$num;
        $exp[] = $length;
        $product_code = implode('/', $exp);

        $product_info = Product::orderBy('product_code', 'desc')->first();
        if( isset($product_info ) ){
            if( str_contains($product_info->product_code, $str ) ) {
                $prefix_value = $product_info->product_code;
                $exp = explode('/', $prefix_value );
                $num = end($exp);
                array_pop($exp);
                $num = $num + 1;
                $length = '';
                if( strlen($num) < 4 ) {
                    $length  = 4 - strlen($num);
                    $length = str_repeat('0', $length);
                }
                $length = $length.$num;
                $exp[] = $length;
                $product_code = implode('/', $exp);
            } 
        }
            
        return $product_code;
    }

    public static function get_invoice_code() {
        $prefix = PrefixSetting::where('prefix_field', 'Invoice')->first();
        $prefix_value = $prefix->prefix_value;
       
        $exp = explode('/', $prefix_value );
        $str = $exp[0];
        $num = end($exp);
        array_pop($exp);
        $num = $num + 1;
        $length = '';
        if( strlen($num) < 4 ) {
            $length  = 4 - strlen($num);
            $length = str_repeat('0', $length);
        }
        $length = $length.$num;
        $exp[] = $length;
        $invoice_no = implode('/', $exp);
        $invoice_info = Invoice::orderBy('invoice_no', 'desc')->first();
        if( isset( $invoice_info ) ){
            if( str_contains($invoice_info->invoice_no, $str ) ) {
                $prefix_value = $invoice_info->invoice_no;
                $exp = explode('/', $prefix_value );
                $num = end($exp);
                array_pop($exp);
                $num = $num + 1;
                $length = '';
                if( strlen($num) < 4 ) {
                    $length  = 4 - strlen($num);
                    $length = str_repeat('0', $length);
                }
                $length = $length.$num;
                $exp[] = $length;
                $invoice_no = implode('/', $exp);
            } 
        }
        return $invoice_no;
    }

    public static function setMailConfig(){

        //Get the data from settings table
        $settings = CompanySettings::find(1); 

        //Set the data in an array variable from settings table
        $mailConfig = [
            'transport' => 'smtp',
            'host' => $settings->smtp_host,
            'port' => $settings->smtp_port,
            'encryption' => $settings->mail_encryption,
            'username' => $settings->smtp_user,
            'password' => $settings->smtp_password,
            'timeout' => null
        ];

        //To set configuration values at runtime, pass an array to the config helper
        config(['mail.mailers.smtp' => $mailConfig]);
    }
}