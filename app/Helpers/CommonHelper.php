<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\PrefixSetting;


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
            
        return $product_code;
    }
}