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

    public static function set_lead_order($user_id, $role_id, $type) {
        $check = DB::table('lead_orders')->where('user_id', $user_id)->where('status', 1)->first();

        if( self::check_role_has_permission('leads', $role_id) && $type == 'add') {
            if(isset($check) && !empty($check)) {

            } else {
                DB::table('lead_orders')->insert([
                    'user_id' => $user_id, 
                    'order' => self::get_leads_order_no(), 
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')    
                ]);
                return true;
            }   
        } else {
            if(isset($check) && !empty($check)) {
                $check = DB::table('lead_orders')->where('user_id', $user_id)->where('status', 1)->delete();
            }
            return true;
        }
    }

    public static function check_role_has_permission($menu, $role_id) {
        $info = DB::table('role_permissions')
                    ->join('role_permission_menu', function ($join) use ($menu) {
                        $join->on('role_permissions.id', '=', 'role_permission_menu.permission_id')
                            ->where('role_permission_menu.menu', '=', $menu);
                    })->where('role_permissions.role_id', $role_id)->first();

        if( isset($info) && !empty($info)) {
            
            if( isset( $info->is_assign ) && $info->is_assign == 'on') {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function get_leads_order_no() {
        $info = DB::table('lead_orders')->orderByDesc('id')->first();
        $order = 0;
        if( isset($info) && !empty($info)) {
            $order = $info->order;
        }
        return $order + 1;
    }

    public static function get_deals_order_no() {
        $info = DB::table('deal_orders')->orderByDesc('id')->first();
        $order = 0;
        if( isset($info) && !empty($info)) {
            $order = $info->order;
        }
        return $order + 1;
    }

    public static function set_deal_order($user_id, $role_id, $type) {
        $check = DB::table('deal_orders')->where('user_id', $user_id)->where('status', 1)->first();

        if( self::check_role_has_permission('deals', $role_id) && $type == 'add') {
            if(isset($check) && !empty($check)) {

            } else {
                DB::table('deal_orders')->insert([
                    'user_id' => $user_id, 
                    'order' => self::get_deals_order_no(), 
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')    
                ]);
                return true;
            }   
        } else {
            if(isset($check) && !empty($check)) {
                $check = DB::table('deal_orders')->where('user_id', $user_id)->where('status', 1)->delete();
            }
            return true;
        }
    }

    public static function getLeadAssigner() {
        $set_info = DB::table('company_settings')->where('id', 1)->first();
        $user_id = '';
        if( isset( $set_info ) && !empty($set_info) && $set_info->lead_access == 'roundrobin' ) {
            if( isset($set_info->last_lead_order) && !empty($set_info->last_lead_order) ) {
                $order_no = $set_info->last_lead_order;
                $count = DB::table('lead_orders')->count();
                $get_user = DB::table('lead_orders')->where('order', '>', $order_no)->orderBy('order')->first();
                if( isset( $get_user ) && !empty($get_user ) ) {
                    $user_id = $get_user->user_id;
                } else {
                    if( $count > 0 ) {
                        $get_user = DB::table('lead_orders')->where('order', $order_no)->first();
                        if( isset( $get_user ) && !empty($get_user ) ) {
                            $user_id = $get_user->user_id;
                        }

                    }
                }
            } else {
                $get_user = DB::table('lead_orders')->orderBy('order')->first();

                if( isset( $get_user ) && !empty($get_user ) ) {
                    $user_id = $get_user->user_id;
                }
            }
        } 
        if( !empty($user_id)) {
            DB::table('company_settings')->where('id', 1)->update(['last_lead_order' => $get_user->order ?? null]);
            return $user_id;
        }
        return null;
        
    }

    public static function send_lead_notification( $lead_id, $user_id = '') {
        $lead_order_info = DB::table('lead_orders')->get();
        
        if( $user_id ) {
            $ins = array(
                'title' => 'New Enquiry',
                'message' => 'Customer has come, Please welcome customer',
                'type' => 'lead',
                'url' => route('leads.view', ['id' => $lead_id]),
                'type_id' => $lead_id,
                'user_id' => $user_id,
                'created_at' => date('Y-m-d H:i:s')
            );

            
        } else {
            if( isset( $lead_order_info ) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {
                    $ins[] = array(
                                'title' => 'New Enquiry',
                                'message' => 'Customer has come, Please welcome customer',
                                'type' => 'lead',
                                'url' => route('leads.view', ['id' => $lead_id]),
                                'type_id' => $lead_id,
                                'user_id' => $item->user_id,
                                'created_at' => date('Y-m-d H:i:s')
                    );
                }
            } 
        }
        if( !empty( $ins ) ) {
            DB::table('notifications')->insert($ins);
        }
        return true;
    }

    
}