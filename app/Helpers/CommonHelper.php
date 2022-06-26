<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\Deal;
use App\Models\Activity;
use App\Models\User;
use App\Models\DealStage;
use App\Models\PrefixSetting;
use App\Models\CompanySettings;
use Auth;

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

    public static function send_lead_notification( $lead_id, $user_id = '', $is_manual = '', $update = '') {
        $lead_order_info = DB::table('lead_orders')->get();
        $title = 'New Enquiry';
        if( !empty($update)){
            $title = 'Enquiry Updates';
        }
        $date_div = '<strong class="text-primary">'.date('d M Y h:i A').'</strong>';
        
        if( $user_id ) {
            $lead_info = Lead::find($lead_id);
            $user_info = User::find($user_id);
            if( !empty($update)){
                $message = 'Lead Enquiry '.$lead_info->lead_subject.' has made some changes please view to see changes. Changes made by <span class="text-success">'.Auth::user()->name.' '.(Auth::user()->last_name ?? '').'</span> at '.$date_div;
            } else {
                if( Auth::id() ) {
                    $message = 'Lead Enquiry '.$lead_info->lead_subject.' has assigned to <span class="text-success">'.$user_info->name.' '.($user_info->last_name ?? '').'</span> and assigned by '.Auth::user()->name.' '.(Auth::user()->last_name ?? '').' at '.$date_div;
                } else {
                    $message = 'Lead Enquiry '.$lead_info->lead_subject.' has come to <span class="text-succes">'.$user_info->name.' '.($user_info->last_name ?? '').'</span> and it is autoassigned at '.$date_div;
                }
            }
            
            
            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'lead',
                'url' => route('leads.view', ['id' => $lead_id]),
                'type_id' => $lead_id,
                'user_id' => $user_id,
                'assigned_by' => Auth::id() ?? null,
                'created_at' => date('Y-m-d H:i:s')
            );

            
        } else {
            if( isset( $lead_order_info ) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {

                    $lead_info = Lead::find($lead_id);
                    $user_info = User::find($item->user_id);
                    if( !empty($update)){
                        $message = 'Lead Enquiry '.$lead_info->lead_subject.' has made some changes please view to see changes. Changes made by <span class="text-success">'.Auth::user()->name.' '.(Auth::user()->last_name ?? '').'</span> at '.$date_div;
                    } else {
                        if( Auth::id() ) {
                            $message = 'Lead Enquiry '.$lead_info->lead_subject.' has assigned to <span class="text-success">'.$user_info->name.' '.($user_info->last_name ?? '').'</span> and assigned by '.Auth::user()->name.' '.(Auth::user()->last_name ?? '').' at '.$date_div;
                        } else {
                            $message = 'Lead Enquiry '.$lead_info->lead_subject.' has come to <span class="text-succes">'.$user_info->name.' '.($user_info->last_name ?? '').'</span> and it is autoassigned at '.$date_div;
                        }
                    }

                    $ins[] = array(
                                'title' => $title,
                                'message' => $message,
                                'type' => 'lead',
                                'url' => route('leads.view', ['id' => $lead_id]),
                                'type_id' => $lead_id,
                                'assigned_by' => Auth::id() ?? null,
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

    public static function send_lead_activity_notification( $activity_id, $assigned_to = '', $update = '') {
        $lead_order_info = DB::table('lead_orders')->get();
        $title = 'New Lead Activity Added';
        if( !empty($update)){
            $title = 'Changes Made on Lead Activity';
        }
        $act_info = Activity::find($activity_id);
      
        $date_div = '<strong class="text-primary">'.date('d M Y h:i A').'</strong>';
        if( $assigned_to ) {
            
            if( !empty($update)){
                $message = 'Activity '.$act_info->subject.' has made some changes please view to see changes. Changes made by <span class="text-info">'.Auth::user()->name.' '.(Auth::user()->last_name ?? '').'</span> at '.$date_div;
            } else {
                $message = 'Activity '.$act_info->subject.' has assigned to <span class="text-success">'.$act_info->user->name.'</span> created by <span class="text-info">'. Auth::user()->name.'</span> at '.$date_div;
            }
            
            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'lead-activity',
                'url' => route('leads.view', ['id' => $act_info->lead_id]),
                'type_id' => $activity_id,
                'user_id' => $act_info->lead->assigned_to,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );

            if( isset($act_info->lead->assigned_by) && !empty($act_info->lead->assigned_by)){
                $user_info = User::find($act_info->lead->assigned_by);

                $ins[] = array(
                    'title' => $title,
                    'message' => $message,
                    'type' => 'lead-activity',
                    'url' => route('leads.view', ['id' => $act_info->lead_id]),
                    'type_id' => $activity_id,
                    'user_id' => $act_info->lead->assigned_by,
                    'assigned_by' => null,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }

            
        } else {
            if( isset( $lead_order_info ) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {

                    $lead_info = Lead::find( $act_info->lead_id);
                    $user_info = User::find($item->user_id);
                    if( !empty($update)){
                        $message = 'Activity '.$act_info->subject.' has made some changes please view to see changes. Changes made by <span class="text-info">'.Auth::user()->name.' '.(Auth::user()->last_name ?? '').'</span> at '.$date_div;
                    } else {
                        $message = 'Activity '.$act_info->subject.' has assigned to <span class="text-success">'.$act_info->user->name.'</span> created by <span class="text-info">'. Auth::user()->name.'</span> at '.$date_div;
                    }

                    $ins[] = array(
                                'title' => $title,
                                'message' => $message,
                                'type' => 'lead',
                                'url' => route('leads.view', ['id' => $act_info->lead_id]),
                                'type_id' => $activity_id,
                                'assigned_by' => Auth::id() ?? null,
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

    public static function send_lead_activity_done_notification( $activity_id, $lead_id) {
        $lead_order_info = DB::table('lead_orders')->get();
        $title = 'Lead Activity has been Done';
        
        $act_info = Activity::find($activity_id);
        $lead_info = Lead::find($lead_id);
      
        $date_div = '<strong class="text-primary">'.date('d M Y h:i A').'</strong>';
        if( isset($lead_info->assigned_to ) && !empty($lead_info->assigned_to) ) {
           
            $message = 'Activity '.$act_info->subject.' has been completed by <span class="text-info">'. Auth::user()->name.'</span> at '.$date_div;
            
            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'lead-activity-done',
                'url' => route('leads.view', ['id' => $act_info->lead_id]),
                'type_id' => $activity_id,
                'user_id' => $act_info->lead->assigned_to,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );

            if( isset($act_info->lead->assigned_by) && !empty($act_info->lead->assigned_by)){
                $user_info = User::find($act_info->lead->assigned_by);

                $ins[] = array(
                    'title' => $title,
                    'message' => $message,
                    'type' => 'lead-activity-done',
                    'url' => route('leads.view', ['id' => $act_info->lead_id]),
                    'type_id' => $activity_id,
                    'user_id' => $act_info->lead->assigned_by,
                    'assigned_by' => null,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }

            
        } else {
            if( isset( $lead_order_info ) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {

                    $lead_info = Lead::find( $act_info->lead_id);
                    $user_info = User::find($item->user_id);
                    $message = 'Activity '.$act_info->subject.' has been completed by <span class="text-info">'. Auth::user()->name.'</span> at '.$date_div;

                    $ins[] = array(
                                'title' => $title,
                                'message' => $message,
                                'type' => 'lead-activity-done',
                                'url' => route('leads.view', ['id' => $act_info->lead_id]),
                                'type_id' => $activity_id,
                                'assigned_by' => Auth::id() ?? null,
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


    public static function send_lead_activity_delete_notification( $activity_id, $lead_id) {
        
        $lead_order_info = DB::table('lead_orders')->get();
        $act_info = Activity::find($activity_id);
        $lead_info = Lead::find($lead_id);
        $date_div = '<strong class="text-primary">'.date('d M Y h:i A').'</strong>';

        $title = 'Lead Activity has been Deleted';
        $message = 'Activity '.$act_info->subject.' has been deleted by <span class="text-info">'. Auth::user()->name.'</span> at '.$date_div;
        
        if( isset($lead_info->assigned_to ) && !empty($lead_info->assigned_to) ) {
            
            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'lead-activity-done',
                'url' => route('leads.view', ['id' => $act_info->lead_id]),
                'type_id' => $activity_id,
                'user_id' => $act_info->lead->assigned_to,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );

            if( isset($act_info->lead->assigned_by) && !empty($act_info->lead->assigned_by)){
                $user_info = User::find($act_info->lead->assigned_by);

                $ins[] = array(
                    'title' => $title,
                    'message' => $message,
                    'type' => 'lead-activity-done',
                    'url' => route('leads.view', ['id' => $act_info->lead_id]),
                    'type_id' => $activity_id,
                    'user_id' => $act_info->lead->assigned_by,
                    'assigned_by' => null,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }

            
        } else {
            if( isset( $lead_order_info ) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {

                    $lead_info = Lead::find( $act_info->lead_id);
                    $user_info = User::find($item->user_id);

                    $ins[] = array(
                                'title' => $title,
                                'message' => $message,
                                'type' => 'lead-activity-done',
                                'url' => route('leads.view', ['id' => $act_info->lead_id]),
                                'type_id' => $activity_id,
                                'assigned_by' => Auth::id() ?? null,
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

    public static function send_lead_delete_notification($lead_id) {

        $lead_order_info = DB::table('lead_orders')->get();
        $lead_info = Lead::find($lead_id);

        $title = 'Lead Deleted';
        $date_div = '<strong class="text-primary">'.date('d M Y h:i A').'</strong>';

        $message = 'Lead '.$lead_info->lead_subject.' has been deleted by <span class="text-success">'.Auth::user()->name.' '.(Auth::user()->last_name ?? '').'</span> at '.$date_div;
        
        if( isset($lead_info->assigned_to) && !empty($lead_info->assigned_to) ) {
            
            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'lead-delete',
                'url' => 'javascript:void(0)',
                'type_id' => $lead_id,
                'user_id' => $lead_info->assigned_to,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );

            if( isset($lead_info->assigned_by) && !empty($lead_info->assigned_by)){
                $user_info = User::find($lead_info->assigned_by);

                $ins[] = array(
                    'title' => $title,
                    'message' => $message,
                    'type' => 'lead-delete',
                    'url' => 'javascript:void(0);',
                    'type_id' => $lead_id,
                    'user_id' => $lead_info->assigned_by,
                    'assigned_by' => null,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }

            
        } else {
            if( isset( $lead_order_info ) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {

                    $lead_info = Lead::find( $lead_id);
                    $user_info = User::find( $item->user_id);

                    $ins[] = array(
                                'title' => $title,
                                'message' => $message,
                                'type' => 'lead-delete',
                                'url' => 'javascript:void(0);',
                                'type_id' => $lead_id,
                                'assigned_by' => null,
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

    public static function send_deal_conversion_notification($lead_id) {

        $lead_order_info = DB::table('lead_orders')->get();
        $lead_info = Lead::find($lead_id);
        $date_div = '<strong class="text-primary">'.date('d M Y h:i A').'</strong>';
        
        $title = 'Lead Converted to Deal';
        $message = 'Lead '.$lead_info->lead_subject.' has been converted to Deal by '.Auth::user()->name.' '.(Auth::user()->last_name ?? '').' at '.$date_div;
        
        if( isset($lead_info->assigned_to) && !empty($lead_info->assigned_to) ) {
            
            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'lead-conversion',
                'url' => route('leads.view', ['id' => $lead_id]),
                'type_id' => $lead_id,
                'user_id' => $lead_info->assigned_to,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );

            if( isset($lead_info->assigned_by) && !empty($lead_info->assigned_by)){
                $user_info = User::find($lead_info->assigned_by);

                $ins[] = array(
                    'title' => $title,
                    'message' => $message,
                    'type' => 'lead-conversion',
                    'url' => route('leads.view', ['id' => $lead_id]),
                    'type_id' => $lead_id,
                    'user_id' => $lead_info->assigned_by,
                    'assigned_by' => null,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }
            
        } else {
            if( isset( $lead_order_info ) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {

                    $lead_info = Lead::find( $lead_id);
                    $user_info = User::find( $item->user_id);

                    $ins[] = array(
                                'title' => $title,
                                'message' => $message,
                                'type' => 'lead-conversion',
                                'url' => route('leads.view', ['id' => $lead_id]),
                                'type_id' => $lead_id,
                                'assigned_by' => null,
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

    //deal notification started
    public static function send_deal_notification( $deal_id, $user_id = '', $update = '') {

        $deal_order_info = DB::table('deal_orders')->get();
        $title = 'New Deal Added';
        if( !empty($update)) {
            $title = 'Deal made changes';
        }
        $date_div = '<strong class="text-primary">'.date('d M Y h:i A').'</strong>';
        
        if( $user_id ) {
            $deal_info = Deal::find($deal_id);
            $user_info = User::find($user_id);
            if( !empty($update)){
                $message = 'Deal '.$deal_info->deal_title.' has made some changes please view to see changes. Changes made by '.Auth::user()->name.' '.(Auth::user()->last_name ?? '').' at '.$date_div;
            } else {
                if( Auth::id() ) {
                    $message = 'Deal '.$deal_info->deal_title.' has assigned to <span class="text-success">'.$user_info->name.' '.($user_info->last_name ?? '').'</span> and assigned by <span class="text-info">'.Auth::user()->name.' '.(Auth::user()->last_name ?? '').'</span> at '.$date_div;
                } else {
                    $message = 'Deal '.$deal_info->deal_title.' has come to <span class="text-success">'.$user_info->name.' '.($user_info->last_name ?? '').'</span> and it is autoassigned at '.$date_div;
                }
            }
            
            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'deal',
                'url' => route('deals.view', ['id' => $deal_id]),
                'type_id' => $deal_id,
                'user_id' => $user_id,
                'assigned_by' => Auth::id() ?? null,
                'created_at' => date('Y-m-d H:i:s')
            );
            
        } else {
            if( isset( $deal_order_info ) && !empty($deal_order_info)) {
                foreach ($deal_order_info as $item) {

                    $deal_info = Deal::find($deal_id);
                    $user_info = User::find($item->user_id);
                    if( !empty($update)){
                        $message = 'Deal '.$deal_info->deal_title.' has made some changes please view to see changes. Changes made by '.Auth::user()->name.' '.(Auth::user()->last_name ?? '').' at '.$date_div;
                    } else {
                        if( Auth::id() ) {
                            $message = 'Deal '.$deal_info->deal_title.' has assigned to <span class="text-success">'.$user_info->name.' '.($user_info->last_name ?? '').'</span> and assigned by <span class="text-info">'.Auth::user()->name.' '.(Auth::user()->last_name ?? '').'</span> at '.$date_div;
                        } else {
                            $message = 'Deal '.$deal_info->deal_title.' has come to <span class="text-success">'.$user_info->name.' '.($user_info->last_name ?? '').'</span> and it is autoassigned at '.$date_div;
                        }
                    }

                    $ins[] = array(
                                'title' => $title,
                                'message' => $message,
                                'type' => 'deal',
                                'url' => route('deals.view', ['id' => $deal_id]),
                                'type_id' => $deal_id,
                                'assigned_by' => Auth::id() ?? null,
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

    public static function send_deal_activity_notification( $activity_id, $assigned_to = '', $update = '') {
        $lead_order_info = DB::table('deal_orders')->get();
        $title = 'New Deal Activity Added';
        if( !empty($update)){
            $title = 'Changes Made on Deal Activity';
        }
        $act_info = Activity::find($activity_id);
      
        $date_div = '<strong class="text-primary">'.date('d M Y h:i A').'</strong>';
        if( $assigned_to ) {
            
            if( !empty($update)) {
                $message = 'Activity '.$act_info->subject.' has made some changes please view to see changes. Changes made by <span class="text-info">'.Auth::user()->name.' '.(Auth::user()->last_name ?? '').'</span> at '.$date_div;
            } else {
                $message = 'Activity '.$act_info->subject.' has assigned to <span class="text-success">'.$act_info->user->name.'</span> created by <span class="text-info">'. Auth::user()->name.'</span> at '.$date_div;
            }
            
            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'deal-activity',
                'url' => route('deals.view', ['id' => $act_info->deal_id]),
                'type_id' => $activity_id,
                'user_id' => $act_info->deal->assigned_to,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );

            if( isset($act_info->deal->assigned_by) && !empty($act_info->deal->assigned_by)) {
                $user_info = User::find($act_info->deal->assigned_by);

                $ins[] = array(
                    'title' => $title,
                    'message' => $message,
                    'type' => 'deal-activity',
                    'url' => route('deals.view', ['id' => $act_info->deal_id]),
                    'type_id' => $activity_id,
                    'user_id' => $act_info->deal->assigned_by,
                    'assigned_by' => null,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }

            
        } else {
            if( isset( $lead_order_info ) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {

                    $user_info = User::find($item->user_id);
                    if( !empty($update)){
                        $message = 'Activity '.$act_info->subject.' has made some changes please view to see changes. Changes made by <span class="text-info">'.Auth::user()->name.' '.(Auth::user()->last_name ?? '').'</span> at '.$date_div;
                    } else {
                        $message = 'Activity '.$act_info->subject.' has assigned to <span class="text-success">'.$act_info->user->name.'</span> created by <span class="text-info">'. Auth::user()->name.'</span> at '.$date_div;
                    }

                    $ins[] = array(
                                'title' => $title,
                                'message' => $message,
                                'type' => 'deal-activity',
                                'url' => route('deals.view', ['id' => $act_info->deal_id]),
                                'type_id' => $activity_id,
                                'assigned_by' => Auth::id() ?? null,
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

    public static function send_deal_activity_delete_notification( $activity_id, $deal_id) {
        
        $deal_order_info = DB::table('deal_orders')->get();
        $act_info = Activity::find($activity_id);
        $deal_info = Deal::find($deal_id);
        $date_div = '<strong class="text-primary">'.date('d M Y h:i A').'</strong>';

        $title = 'Deal Activity has been Deleted';
        $message = 'Activity '.$act_info->subject.' has been deleted by <span class="text-info">'. Auth::user()->name.'</span> at '.$date_div;
        
        if( isset($deal_info->assigned_to ) && !empty($deal_info->assigned_to) ) {
            
            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'deal-activity-done',
                'url' => route('deals.view', ['id' => $act_info->deal_id]),
                'type_id' => $activity_id,
                'user_id' => $act_info->deal->assigned_to,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );

            if( isset($act_info->deal->assigned_by) && !empty($act_info->deal->assigned_by)) {
                $user_info = User::find($act_info->deal->assigned_by);

                $ins[] = array(
                    'title' => $title,
                    'message' => $message,
                    'type' => 'deal-activity-done',
                    'url' => route('deals.view', ['id' => $act_info->deal_id]),
                    'type_id' => $activity_id,
                    'user_id' => $act_info->deal->assigned_by,
                    'assigned_by' => null,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }

        } else {
            if( isset( $deal_order_info ) && !empty($deal_order_info)) {
                foreach ($deal_order_info as $item) {

                    $ins[] = array(
                                'title' => $title,
                                'message' => $message,
                                'type' => 'deal-activity-done',
                                'url' => route('deals.view', ['id' => $act_info->deal_id]),
                                'type_id' => $activity_id,
                                'assigned_by' => Auth::id() ?? null,
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

    public static function send_deal_activity_done_notification( $activity_id, $deal_id) {
        $deal_order_info = DB::table('deal_orders')->get();
        $title = 'Deal Activity has been Done';
        
        $act_info = Activity::find($activity_id);
        $deal_info = Deal::find($deal_id);
      
        $date_div = '<strong class="text-primary">'.date('d M Y h:i A').'</strong>';
        if( isset($deal_info->assigned_to ) && !empty($deal_info->assigned_to) ) {
           
            $message = 'Activity '.$act_info->subject.' has been completed by <span class="text-info">'. Auth::user()->name.'</span> at '.$date_div;
            
            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'deal-activity-done',
                'url' => route('deals.view', ['id' => $act_info->deal_id]),
                'type_id' => $activity_id,
                'user_id' => $act_info->deal->assigned_to,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );

            if( isset($act_info->deal->assigned_by) && !empty($act_info->deal->assigned_by)){
                $user_info = User::find($act_info->deal->assigned_by);

                $ins[] = array(
                    'title' => $title,
                    'message' => $message,
                    'type' => 'deal-activity-done',
                    'url' => route('deals.view', ['id' => $act_info->deal_id]),
                    'type_id' => $activity_id,
                    'user_id' => $act_info->deal->assigned_by,
                    'assigned_by' => null,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }

            
        } else {
            if( isset( $deal_order_info ) && !empty($deal_order_info)) {
                foreach ($deal_order_info as $item) {

                    $message = 'Activity '.$act_info->subject.' has been completed by <span class="text-info">'. Auth::user()->name.'</span> at '.$date_div;

                    $ins[] = array(
                                'title' => $title,
                                'message' => $message,
                                'type' => 'deal-activity-done',
                                'url' => route('deals.view', ['id' => $act_info->deal_id]),
                                'type_id' => $activity_id,
                                'assigned_by' => Auth::id() ?? null,
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

    public static function send_deal_stage_notification( $deal_id, $stage_id) {
        $deal_order_info = DB::table('deal_orders')->get();
        $title = 'Deal Stage has been Completed';
        
        $deal_info = Deal::find($deal_id);
        $deal_stage_info = DealStage::find($deal_info->current_stage_id);
        $new_stage_info = DealStage::find($stage_id);
      
        $date_div = '<strong class="text-primary">'.date('d M Y h:i A').'</strong>';
        $message = 'Deal Stage '.$deal_stage_info->stages.' has been completed by <span class="text-info">'. Auth::user()->name.'</span> at '.$date_div;

        if( isset($deal_info->assigned_to ) && !empty($deal_info->assigned_to) ) {
           
            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'deal-stage-done',
                'url' => route('deals.view', ['id' => $deal_id]),
                'type_id' => $stage_id,
                'user_id' => $deal_info->assigned_to,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );

            if( isset($deal_info->assigned_by) && !empty($deal_info->assigned_by)){
                $user_info = User::find($deal_info->assigned_by);

                $ins[] = array(
                    'title' => $title,
                    'message' => $message,
                    'type' => 'deal-stage-done',
                    'url' => route('deals.view', ['id' => $deal_id]),
                    'type_id' => $stage_id,
                    'user_id' => $deal_info->assigned_by,
                    'assigned_by' => null,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }

            
        } else {
            if( isset( $deal_order_info ) && !empty($deal_order_info)) {
                foreach ($deal_order_info as $item) {


                    $ins[] = array(
                                'title' => $title,
                                'message' => $message,
                                'type' => 'deal-stage-done',
                                'url' => route('deals.view', ['id' => $deal_id]),
                                'type_id' => $stage_id,
                                'assigned_by' => Auth::id() ?? null,
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

    public static function send_deal_winLoss_notification( $deal_id, $status) {
        $deal_order_info = DB::table('deal_orders')->get();
        $deal_info = Deal::find($deal_id);

        $date_div = '<strong class="text-primary">'.date('d M Y h:i A').'</strong>';
        if( $status == 2 ) {
            $title = 'Deal has won';
            $message = 'Deal has won by <span class="text-info">'. Auth::user()->name.'</span> at '.$date_div;
        } else if( $status == 3 ) {
            $title = 'Deal has lost';
            $message = 'Deal has lost by <span class="text-info">'. Auth::user()->name.'</span> at '.$date_div;
        } else if( $status == 1 ) {
            $title = 'Deal has Reopened';
            $message = 'Deal has reopened by <span class="text-info">'. Auth::user()->name.'</span> at '.$date_div;
        }
        
        if( isset($deal_info->assigned_to ) && !empty($deal_info->assigned_to) ) {
           
            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'deal-win-loss',
                'url' => route('deals.view', ['id' => $deal_id]),
                'type_id' => $deal_id,
                'user_id' => $deal_info->assigned_to,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );

            if( isset($deal_info->assigned_by) && !empty($deal_info->assigned_by)){
                $user_info = User::find($deal_info->assigned_by);

                $ins[] = array(
                    'title' => $title,
                    'message' => $message,
                    'type' => 'deal-win-loss',
                    'url' => route('deals.view', ['id' => $deal_id]),
                    'type_id' => $deal_id,
                    'user_id' => $deal_info->assigned_by,
                    'assigned_by' => null,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }

            
        } else {
            if( isset( $deal_order_info ) && !empty($deal_order_info)) {
                foreach ($deal_order_info as $item) {


                    $ins[] = array(
                                'title' => $title,
                                'message' => $message,
                                'type' => 'deal-won-loss',
                                'url' => route('deals.view', ['id' => $deal_id]),
                                'type_id' => $deal_id,
                                'assigned_by' => Auth::id() ?? null,
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

    public static function send_deal_delete_notification($deal_id) {

        $deal_order_info = DB::table('deal_orders')->get();
        $deal_info = Deal::find($deal_id);

        $title = 'Deal Deleted';
        $date_div = '<strong class="text-primary">'.date('d M Y h:i A').'</strong>';

        $message = 'Deal '.$deal_info->deal_title.' has been deleted by <span class="text-success">'.Auth::user()->name.' '.(Auth::user()->last_name ?? '').'</span> at '.$date_div;
        
        if( isset($deal_info->assigned_to) && !empty($deal_info->assigned_to) ) {
            
            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'deal-delete',
                'url' => 'javascript:void(0)',
                'type_id' => $deal_id,
                'user_id' => $deal_info->assigned_to,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );

            if( isset($deal_info->assigned_by) && !empty($deal_info->assigned_by)){
                $user_info = User::find($deal_info->assigned_by);

                $ins[] = array(
                    'title' => $title,
                    'message' => $message,
                    'type' => 'deal-delete',
                    'url' => 'javascript:void(0);',
                    'type_id' => $deal_id,
                    'user_id' => $deal_info->assigned_by,
                    'assigned_by' => null,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }
        } else {
            if( isset( $deal_order_info ) && !empty($deal_order_info)) {
                foreach ($deal_order_info as $item) {

                    $ins[] = array(
                                'title' => $title,
                                'message' => $message,
                                'type' => 'deal-delete',
                                'url' => 'javascript:void(0);',
                                'type_id' => $deal_id,
                                'assigned_by' => null,
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

    public static function send_activity_status_change_notification( $activity_id ) {
        
        $lead_order_info = DB::table('lead_orders')->get();
        $act_info = Activity::find($activity_id);
        $date_div = '<strong class="text-primary">'.date('d M Y h:i A').'</strong>';
        
        $title = 'Activity status has been Changed';
        $message = 'Activity '.$act_info->subject.' status has been changed to '.$act_info->statusAll->status_name.' by <span class="text-info">'. Auth::user()->name.'</span> at '.$date_div;
        $ins = [];
        if( $act_info->added_by == $act_info->user_id ) {
            
            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'activity-change-status',
                'url' => route('activities'),
                'type_id' => $activity_id,
                'user_id' => $act_info->added_by,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );
        } else if( $act_info->added_by != $act_info->user_id ) {
            
            $ins[] = array(
                'title' => $title,
                'message' => $message,
                'type' => 'activity-change-status',
                'url' => route('activities'),
                'type_id' => $activity_id,
                'user_id' => $act_info->added_by,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );
            $ins[] = array(
                'title' => $title,
                'message' => $message,
                'type' => 'activity-change-status',
                'url' => route('activities'),
                'type_id' => $activity_id,
                'user_id' => $act_info->user_id,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );
        }
       
        if( !empty( $ins ) ) {
            DB::table('notifications')->insert($ins);
        }
        return true;
    }

    

    
}