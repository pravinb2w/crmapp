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
use App\Models\Customer;
use App\Models\CustomerDocument;
use App\Models\Organization;
use Auth;

class CommonHelper
{
    public static function getExpiry($period, $start_date)
    {
        $period = explode("-", $period);
        $day = $period[0];
        $start = date('Y-m-d', strtotime($start_date));
        if (strtolower($period[1]) == 'm') {
            return date('Y-m-d', strtotime('+' . $day . ' month', strtotime($start)));
        } else if (strtolower($period[1]) == 'y') {
            return date('Y-m-d', strtotime('+' . $day . ' year', strtotime($start)));
        } else if (strtolower($period[1]) == 'd') {
            return date('Y-m-d', strtotime('+' . $day . ' days', strtotime($start)));
        }
    }

    public static function get_product_code()
    {
        $prefix = PrefixSetting::where('prefix_field', 'Product')->first();
        $prefix_value = $prefix->prefix_value;

        $exp = explode('/', $prefix_value);
        $str = $exp[0];
        $num = end($exp);
        array_pop($exp);
        $num = $num + 1;
        $length = '';
        if (strlen($num) < 4) {
            $length  = 4 - strlen($num);
            $length = str_repeat('0', $length);
        }
        $length = $length . $num;
        $exp[] = $length;
        $product_code = implode('/', $exp);

        $product_info = Product::orderBy('product_code', 'desc')->first();
        if (isset($product_info)) {
            if (str_contains($product_info->product_code, $str)) {
                $prefix_value = $product_info->product_code;
                $exp = explode('/', $prefix_value);
                $num = end($exp);
                array_pop($exp);
                $num = $num + 1;
                $length = '';
                if (strlen($num) < 4) {
                    $length  = 4 - strlen($num);
                    $length = str_repeat('0', $length);
                }
                $length = $length . $num;
                $exp[] = $length;
                $product_code = implode('/', $exp);
            }
        }

        return $product_code;
    }

    public static function get_invoice_code()
    {
        $prefix = PrefixSetting::where('prefix_field', 'Invoice')->first();
        $prefix_value = $prefix->prefix_value;

        $exp = explode('/', $prefix_value);
        $str = $exp[0];
        $num = end($exp);
        array_pop($exp);
        $num = $num + 1;
        $length = '';
        if (strlen($num) < 4) {
            $length  = 4 - strlen($num);
            $length = str_repeat('0', $length);
        }
        $length = $length . $num;
        $exp[] = $length;
        $invoice_no = implode('/', $exp);
        $invoice_info = Invoice::orderBy('invoice_no', 'desc')->first();
        if (isset($invoice_info)) {
            if (str_contains($invoice_info->invoice_no, $str)) {
                $prefix_value = $invoice_info->invoice_no;
                $exp = explode('/', $prefix_value);
                $num = end($exp);
                array_pop($exp);
                $num = $num + 1;
                $length = '';
                if (strlen($num) < 4) {
                    $length  = 4 - strlen($num);
                    $length = str_repeat('0', $length);
                }
                $length = $length . $num;
                $exp[] = $length;
                $invoice_no = implode('/', $exp);
            }
        }
        return $invoice_no;
    }

    public static function setMailConfig()
    {

        //Get the data from settings table
        $settings = CompanySettings::find(1);

        //Set the data in an array variable from settings table
        $mailConfig = [
            'transport' => $settings->mailer,
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

    public static function set_lead_order($user_id, $role_id, $type)
    {
        $check = DB::table('lead_orders')->where('user_id', $user_id)->where('status', 1)->first();

        if (self::check_role_has_permission('leads', $role_id) && $type == 'add') {
            if (isset($check) && !empty($check)) {
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
            if (isset($check) && !empty($check)) {
                $check = DB::table('lead_orders')->where('user_id', $user_id)->where('status', 1)->delete();
            }
            return true;
        }
    }

    public static function check_role_has_permission($menu, $role_id)
    {
        $info = DB::table('role_permissions')
            ->join('role_permission_menu', function ($join) use ($menu) {
                $join->on('role_permissions.id', '=', 'role_permission_menu.permission_id')
                    ->where('role_permission_menu.menu', '=', $menu);
            })->where('role_permissions.role_id', $role_id)->first();

        if (isset($info) && !empty($info)) {

            if (isset($info->is_assign) && $info->is_assign == 'on') {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function get_leads_order_no()
    {
        $info = DB::table('lead_orders')->orderByDesc('id')->first();
        $order = 0;
        if (isset($info) && !empty($info)) {
            $order = $info->order;
        }
        return $order + 1;
    }

    public static function get_deals_order_no()
    {
        $info = DB::table('deal_orders')->orderByDesc('id')->first();
        $order = 0;
        if (isset($info) && !empty($info)) {
            $order = $info->order;
        }
        return $order + 1;
    }

    public static function set_deal_order($user_id, $role_id, $type)
    {
        $check = DB::table('deal_orders')->where('user_id', $user_id)->where('status', 1)->first();

        if (self::check_role_has_permission('deals', $role_id) && $type == 'add') {
            if (isset($check) && !empty($check)) {
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
            if (isset($check) && !empty($check)) {
                $check = DB::table('deal_orders')->where('user_id', $user_id)->where('status', 1)->delete();
            }
            return true;
        }
    }

    public static function getLeadAssigner()
    {
        $set_info = DB::table('company_settings')->where('id', 1)->first();
        $user_id = '';
        if (isset($set_info) && !empty($set_info) && $set_info->lead_access == 'roundrobin') {
            if (isset($set_info->last_lead_order) && !empty($set_info->last_lead_order)) {
                $order_no = $set_info->last_lead_order;
                $count = DB::table('lead_orders')->count();
                $get_user = DB::table('lead_orders')->where('order', '>', $order_no)->orderBy('order')->first();
                if (isset($get_user) && !empty($get_user)) {
                    $user_id = $get_user->user_id;
                } else {
                    if ($count > 0) {
                        $get_user = DB::table('lead_orders')->where('order', $order_no)->first();
                        if (isset($get_user) && !empty($get_user)) {
                            $user_id = $get_user->user_id;
                        }
                    }
                }
            } else {
                $get_user = DB::table('lead_orders')->orderBy('order')->first();

                if (isset($get_user) && !empty($get_user)) {
                    $user_id = $get_user->user_id;
                }
            }
        }
        if (!empty($user_id)) {
            DB::table('company_settings')->where('id', 1)->update(['last_lead_order' => $get_user->order ?? null]);
            return $user_id;
        }
        return null;
    }

    public static function send_lead_notification($lead_id, $user_id = '', $is_manual = '', $update = '')
    {
        //check with automation function

        $lead_order_info = DB::table('lead_orders')->get();
        $title = 'New Enquiry';
        if (!empty($update)) {
            $title = 'Enquiry Updates';
        }
        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';

        if ($user_id) {
            $lead_info = Lead::find($lead_id);
            $user_info = User::find($user_id);
            if (!empty($update)) {
                $message = 'Lead Enquiry ' . $lead_info->lead_subject . ' has made some changes please view to see changes. Changes made by <span class="text-success">' . Auth::user()->name . ' ' . (Auth::user()->last_name ?? '') . '</span> at ' . $date_div;
                $subject = 'Lead Enquiry ' . $lead_info->lead_subject . ' has made some changes please view to see changes.';
            } else {
                if (Auth::id()) {
                    $message = 'Lead Enquiry ' . $lead_info->lead_subject . ' has assigned to <span class="text-success">' . $user_info->name . ' ' . ($user_info->last_name ?? '') . '</span> and assigned by ' . Auth::user()->name . ' ' . (Auth::user()->last_name ?? '') . ' at ' . $date_div;
                    $subject = 'You have received one Fresh Lead';
                } else {
                    $subject = 'You have received one Fresh Lead';
                    $message = 'Lead Enquiry ' . $lead_info->lead_subject . ' has come to <span class="text-succes">' . $user_info->name . ' ' . ($user_info->last_name ?? '') . '</span> and it is autoassigned at ' . $date_div;
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

            $extract = array(
                'rm_name' => $user_info->name,
                'name' => $lead_info->customer->first_name,
                'mobile_no' => $lead_info->customer->mobile_no,
                'email' => $lead_info->customer->email,
                'city' => $lead_info->customer->address ?? 'N/A',
                'source' => 'N/A',
                'subject' => $subject,
                'message' => $message,
            );

            $ins_mail = array(
                'type' => 'lead',
                'type_id' => $lead_id,
                'email_type' => 'fresh_lead_internal',
                'params' => serialize($extract),
                'to' => $user_info->email ?? 'duraibytes@gmail.com'
            );
        } else {
            if (isset($lead_order_info) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {

                    $lead_info = Lead::find($lead_id);
                    $user_info = User::find($item->user_id);
                    if (!empty($update)) {
                        $subject = 'Lead Enquiry ' . $lead_info->lead_subject . ' has made some changes please view to see changes.';
                        $message = 'Lead Enquiry ' . $lead_info->lead_subject . ' has made some changes please view to see changes. Changes made by <span class="text-success">' . Auth::user()->name . ' ' . (Auth::user()->last_name ?? '') . '</span> at ' . $date_div;
                    } else {
                        if (Auth::id()) {
                            $subject = 'You have received one Fresh Lead';
                            $message = 'Lead Enquiry ' . $lead_info->lead_subject . ' has assigned to <span class="text-success">' . $user_info->name . ' ' . ($user_info->last_name ?? '') . '</span> and assigned by ' . Auth::user()->name . ' ' . (Auth::user()->last_name ?? '') . ' at ' . $date_div;
                        } else {
                            $subject = 'You have received one Fresh Lead';
                            $message = 'Lead Enquiry ' . $lead_info->lead_subject . ' has come to <span class="text-succes">' . $user_info->name . ' ' . ($user_info->last_name ?? '') . '</span> and it is autoassigned at ' . $date_div;
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

                    $extract = array(
                        'rm_name' => $user_info->name,
                        'name' => $lead_info->customer->first_name,
                        'mobile_no' => $lead_info->customer->mobile_no,
                        'email' => $lead_info->customer->email,
                        'city' => $lead_info->customer->address ?? 'N/A',
                        'source' => 'N/A',
                        'subject' => $subject,
                        'message' => $message,
                    );

                    $ins_mail[] = array(
                        'type' => 'lead',
                        'type_id' => $lead_id,
                        'email_type' => 'fresh_lead_internal',
                        'params' => serialize($extract),
                        'to' => $user_info->email ?? 'duraibytes@gmail.com'
                    );
                }
            }
        }
        if (!empty($ins)) {
            if (automation('New Lead Addition', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('New Lead Addition', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }

    public static function send_lead_activity_notification($activity_id, $assigned_to = '', $update = '')
    {
        $lead_order_info = DB::table('lead_orders')->get();
        $company = CompanySettings::find(1);

        $title = 'New Lead Activity Added';
        if (!empty($update)) {
            $title = 'Changes Made on Lead Activity';
        }
        $act_info = Activity::find($activity_id);

        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';
        if ($assigned_to) {

            if (!empty($update)) {
                $message = 'Activity ' . $act_info->subject . ' has made some changes please view to see changes. Changes made by <span class="text-info">' . Auth::user()->name . ' ' . (Auth::user()->last_name ?? '') . '</span> at ' . $date_div;
            } else {
                $message = 'Activity ' . $act_info->subject . ' has assigned to <span class="text-success">' . $act_info->user->name . '</span> created by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;
            }
            $user_info = User::find($act_info->lead->assigned_to ?? $assigned_to);

            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'lead-activity',
                'url' => route('leads.view', ['id' => $act_info->lead_id]),
                'type_id' => $activity_id,
                'user_id' => $act_info->lead->assigned_to ?? $assigned_to,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );

            $extract = array(
                'rm_name' => $user_info->name,
                'message' => $message,
                'additional_information' => '',
                'company_name' => $company->site_name,
                'subject' => $title,

            );

            $ins_mail = array(
                'type' => 'Activity',
                'type_id' => $activity_id,
                'email_type' => 'general_task',
                'params' => serialize($extract),
                'to' => $user_info->email ?? 'duraibytes@gmail.com'
            );

            if (isset($act_info->lead->assigned_by) && !empty($act_info->lead->assigned_by)) {
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

                $extract = array(
                    'rm_name' => $user_info->name,
                    'message' => $message,
                    'additional_information' => '',
                    'company_name' => $company->site_name,
                    'subject' => $title,

                );

                $ins_mail[] = array(
                    'type' => 'Activity',
                    'type_id' => $activity_id,
                    'email_type' => 'general_task',
                    'params' => serialize($extract),
                    'to' => $user_info->email ?? 'duraibytes@gmail.com'
                );
            }
        } else {
            if (isset($lead_order_info) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {

                    $lead_info = Lead::find($act_info->lead_id);
                    $user_info = User::find($item->user_id);
                    if (!empty($update)) {
                        $message = 'Activity ' . $act_info->subject . ' has made some changes please view to see changes. Changes made by <span class="text-info">' . Auth::user()->name . ' ' . (Auth::user()->last_name ?? '') . '</span> at ' . $date_div;
                    } else {
                        $message = 'Activity ' . $act_info->subject . ' has assigned to <span class="text-success">' . $act_info->user->name . '</span> created by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;
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

                    $extract = array(
                        'rm_name' => $user_info->name,
                        'message' => $message,
                        'additional_information' => '',
                        'company_name' => $company->site_name,
                        'subject' => $title,

                    );

                    $ins_mail[] = array(
                        'type' => 'Activity',
                        'type_id' => $activity_id,
                        'email_type' => 'general_task',
                        'params' => serialize($extract),
                        'to' => $user_info->email ?? 'duraibytes@gmail.com'
                    );
                }
            }
        }
        if (!empty($ins)) {
            if (automation('Activity on all Leads', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('Activity on all Leads', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }

    public static function send_lead_activity_done_notification($activity_id, $lead_id)
    {
        $lead_order_info = DB::table('lead_orders')->get();
        $company = CompanySettings::find(1);

        $title = 'Lead Activity has been Done';

        $act_info = Activity::find($activity_id);
        $lead_info = Lead::find($lead_id);

        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';
        if (isset($lead_info->assigned_to) && !empty($lead_info->assigned_to)) {
            $user_info = User::find($lead_info->assigned_to);
            $message = 'Activity ' . $act_info->subject . ' has been completed by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;

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

            $extract = array(
                'rm_name' => $user_info->name,
                'message' => $message,
                'additional_information' => '',
                'company_name' => $company->site_name,
                'subject' => $title,

            );

            $ins_mail = array(
                'type' => 'Activity',
                'type_id' => $activity_id,
                'email_type' => 'general_task',
                'params' => serialize($extract),
                'to' => $user_info->email ?? 'duraibytes@gmail.com'
            );

            if (isset($act_info->lead->assigned_by) && !empty($act_info->lead->assigned_by)) {
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

                $extract = array(
                    'rm_name' => $user_info->name,
                    'message' => $message,
                    'additional_information' => '',
                    'company_name' => $company->site_name,
                    'subject' => $title,

                );

                $ins_mail[] = array(
                    'type' => 'Activity',
                    'type_id' => $activity_id,
                    'email_type' => 'general_task',
                    'params' => serialize($extract),
                    'to' => $user_info->email ?? 'duraibytes@gmail.com'
                );
            }
        } else {
            if (isset($lead_order_info) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {

                    $lead_info = Lead::find($act_info->lead_id);
                    $user_info = User::find($item->user_id);
                    $message = 'Activity ' . $act_info->subject . ' has been completed by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;

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

                    $extract = array(
                        'rm_name' => $user_info->name,
                        'message' => $message,
                        'additional_information' => '',
                        'company_name' => $company->site_name,
                        'subject' => $title,

                    );

                    $ins_mail[] = array(
                        'type' => 'Activity',
                        'type_id' => $activity_id,
                        'email_type' => 'general_task',
                        'params' => serialize($extract),
                        'to' => $user_info->email ?? 'duraibytes@gmail.com'
                    );
                }
            }
        }
        if (!empty($ins)) {
            if (automation('Activity on all Leads', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('Activity on all Leads', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }


    public static function send_lead_activity_delete_notification($activity_id, $lead_id)
    {
        $company = CompanySettings::find(1);

        $lead_order_info = DB::table('lead_orders')->get();
        $act_info = Activity::find($activity_id);
        $lead_info = Lead::find($lead_id);
        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';

        $title = 'Lead Activity has been Deleted';
        $message = 'Activity ' . $act_info->subject . ' has been deleted by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;

        if (isset($lead_info->assigned_to) && !empty($lead_info->assigned_to)) {
            $user_info = User::find($lead_info->assigned_to);
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

            $extract = array(
                'rm_name' => $user_info->name,
                'message' => $message,
                'additional_information' => '',
                'company_name' => $company->site_name,
                'subject' => $title,

            );

            $ins_mail = array(
                'type' => 'Activity',
                'type_id' => $activity_id,
                'email_type' => 'general_task',
                'params' => serialize($extract),
                'to' => $user_info->email ?? 'duraibytes@gmail.com'
            );

            if (isset($act_info->lead->assigned_by) && !empty($act_info->lead->assigned_by)) {
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

                $extract = array(
                    'rm_name' => $user_info->name,
                    'message' => $message,
                    'additional_information' => '',
                    'company_name' => $company->site_name,
                    'subject' => $title,

                );

                $ins_mail[] = array(
                    'type' => 'Activity',
                    'type_id' => $activity_id,
                    'email_type' => 'general_task',
                    'params' => serialize($extract),
                    'to' => $user_info->email ?? 'duraibytes@gmail.com'
                );
            }
        } else {
            if (isset($lead_order_info) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {

                    $lead_info = Lead::find($act_info->lead_id);
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

                    $extract = array(
                        'rm_name' => $user_info->name,
                        'message' => $message,
                        'additional_information' => '',
                        'company_name' => $company->site_name,
                        'subject' => $title,

                    );

                    $ins_mail[] = array(
                        'type' => 'Activity',
                        'type_id' => $activity_id,
                        'email_type' => 'general_task',
                        'params' => serialize($extract),
                        'to' => $user_info->email ?? 'duraibytes@gmail.com'
                    );
                }
            }
        }
        if (!empty($ins)) {
            if (automation('Activity on all Leads', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('Activity on all Leads', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }

    public static function send_lead_delete_notification($lead_id)
    {
        $company = CompanySettings::find(1);

        $lead_order_info = DB::table('lead_orders')->get();
        $lead_info = Lead::find($lead_id);

        $title = 'Lead Deleted';
        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';

        $message = 'Lead ' . $lead_info->lead_subject . ' has been deleted by <span class="text-success">' . Auth::user()->name . ' ' . (Auth::user()->last_name ?? '') . '</span> at ' . $date_div;

        if (isset($lead_info->assigned_to) && !empty($lead_info->assigned_to)) {
            $user_info = User::find($lead_info->assigned_to);

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

            $extract = array(
                'rm_name' => $user_info->name,
                'message' => $message,
                'additional_information' => '',
                'company_name' => $company->site_name,
                'subject' => $title,

            );

            $ins_mail = array(
                'type' => 'Lead',
                'type_id' => $lead_id,
                'email_type' => 'general_task',
                'params' => serialize($extract),
                'to' => $user_info->email ?? 'duraibytes@gmail.com'
            );


            if (isset($lead_info->assigned_by) && !empty($lead_info->assigned_by)) {
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

                $extract = array(
                    'rm_name' => $user_info->name,
                    'message' => $message,
                    'additional_information' => '',
                    'company_name' => $company->site_name,
                    'subject' => $title,

                );

                $ins_mail[] = array(
                    'type' => 'Lead',
                    'type_id' => $lead_id,
                    'email_type' => 'general_task',
                    'params' => serialize($extract),
                    'to' => $user_info->email ?? 'duraibytes@gmail.com'
                );
            }
        } else {
            if (isset($lead_order_info) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {

                    $lead_info = Lead::find($lead_id);
                    $user_info = User::find($item->user_id);

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

                    $extract = array(
                        'rm_name' => $user_info->name,
                        'message' => $message,
                        'additional_information' => '',
                        'company_name' => $company->site_name,
                        'subject' => $title,

                    );

                    $ins_mail[] = array(
                        'type' => 'Lead',
                        'type_id' => $lead_id,
                        'email_type' => 'general_task',
                        'params' => serialize($extract),
                        'to' => $user_info->email ?? 'duraibytes@gmail.com'
                    );
                }
            }
        }
        if (!empty($ins)) {
            if (automation('Activity on all Leads', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('Activity on all Leads', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }

    public static function send_deal_conversion_notification($lead_id)
    {
        $lead_order_info = DB::table('lead_orders')->get();
        $lead_info = Lead::find($lead_id);
        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';

        $title = 'Lead Converted to Deal';
        $message = 'Lead ' . $lead_info->lead_subject . ' has been converted to Deal by ' . Auth::user()->name . ' ' . (Auth::user()->last_name ?? '') . ' at ' . $date_div;

        if (isset($lead_info->assigned_to) && !empty($lead_info->assigned_to)) {

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

            $assigned_user = User::find($lead_info->assigned_to);
            $extract = array(
                'rm_name' => $assigned_user->name,
                'name' => $lead_info->customer->first_name,
                'mobile_no' => $lead_info->customer->mobile_no,
                'email' => $lead_info->customer->email,
                'city' => $lead_info->customer->address ?? 'N/A',
                'source' => 'N/A',
                'client_id' => 'N/A',
                'message' => $message,
            );

            $ins_mail = array(
                'type' => 'lead',
                'type_id' => $lead_id,
                'email_type' => 'deal_conversion_internal',
                'params' => serialize($extract),
                'to' => $assigned_user->email ?? 'duraibytes@gmail.com'
            );

            if (isset($lead_info->assigned_by) && !empty($lead_info->assigned_by)) {

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
                $assigned_user = User::find($lead_info->assigned_by);
                $extract = array(
                    'rm_name' => $assigned_user->name,
                    'name' => $lead_info->customer->first_name,
                    'mobile_no' => $lead_info->customer->mobile_no,
                    'email' => $lead_info->customer->email,
                    'city' => $lead_info->customer->address ?? 'N/A',
                    'source' => 'N/A',
                    'client_id' => 'N/A',
                    'message' => $message,
                );

                $ins_mail[] = array(
                    'type' => 'lead',
                    'type_id' => $lead_id,
                    'email_type' => 'deal_conversion_internal',
                    'params' => serialize($extract),
                    'to' => $assigned_user->email ?? 'duraibytes@gmail.com'
                );
            }
        } else {
            if (isset($lead_order_info) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {

                    $lead_info = Lead::find($lead_id);
                    $user_info = User::find($item->user_id);

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

                    $extract = array(
                        'rm_name' => $user_info->name,
                        'name' => $lead_info->customer->first_name,
                        'mobile_no' => $lead_info->customer->mobile_no,
                        'email' => $lead_info->customer->email,
                        'city' => $lead_info->customer->address ?? 'N/A',
                        'source' => 'N/A',
                        'client_id' => 'N/A',
                        'message' => $message,
                    );

                    $ins_mail[] = array(
                        'type' => 'lead',
                        'type_id' => $lead_id,
                        'email_type' => 'deal_conversion_internal',
                        'params' => serialize($extract),
                        'to' => $user_info->email ?? 'duraibytes@gmail.com'
                    );
                }
            }
        }
        if (!empty($ins)) {
            if (automation('Conversion from Lead to Deal', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('Conversion from Lead to Deal', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }

    //deal notification started
    public static function send_deal_notification($deal_id, $user_id = '', $update = '')
    {
        $company = CompanySettings::find(1);

        $deal_order_info = DB::table('deal_orders')->get();
        $title = 'New Deal Added';
        if (!empty($update)) {
            $title = 'Deal made changes';
        }
        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';

        if ($user_id) {
            $deal_info = Deal::find($deal_id);
            $user_info = User::find($user_id);
            if (!empty($update)) {
                $message = 'Deal ' . $deal_info->deal_title . ' has made some changes please view to see changes. Changes made by ' . Auth::user()->name . ' ' . (Auth::user()->last_name ?? '') . ' at ' . $date_div;
            } else {
                if (Auth::id()) {
                    $message = 'Deal ' . $deal_info->deal_title . ' has assigned to <span class="text-success">' . $user_info->name . ' ' . ($user_info->last_name ?? '') . '</span> and assigned by <span class="text-info">' . Auth::user()->name . ' ' . (Auth::user()->last_name ?? '') . '</span> at ' . $date_div;
                } else {
                    $message = 'Deal ' . $deal_info->deal_title . ' has come to <span class="text-success">' . $user_info->name . ' ' . ($user_info->last_name ?? '') . '</span> and it is autoassigned at ' . $date_div;
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

            $extract = array(
                'rm_name' => $user_info->name,
                'message' => $message,
                'additional_information' => '',
                'company_name' => $company->site_name,
                'subject' => $title,

            );

            $ins_mail = array(
                'type' => 'Deal',
                'type_id' => $deal_id,
                'email_type' => 'general_task',
                'params' => serialize($extract),
                'to' => $user_info->email ?? 'duraibytes@gmail.com'
            );
        } else {
            if (isset($deal_order_info) && !empty($deal_order_info)) {
                foreach ($deal_order_info as $item) {

                    $deal_info = Deal::find($deal_id);
                    $user_info = User::find($item->user_id);
                    if (!empty($update)) {
                        $message = 'Deal ' . $deal_info->deal_title . ' has made some changes please view to see changes. Changes made by ' . Auth::user()->name . ' ' . (Auth::user()->last_name ?? '') . ' at ' . $date_div;
                    } else {
                        if (Auth::id()) {
                            $message = 'Deal ' . $deal_info->deal_title . ' has assigned to <span class="text-success">' . $user_info->name . ' ' . ($user_info->last_name ?? '') . '</span> and assigned by <span class="text-info">' . Auth::user()->name . ' ' . (Auth::user()->last_name ?? '') . '</span> at ' . $date_div;
                        } else {
                            $message = 'Deal ' . $deal_info->deal_title . ' has come to <span class="text-success">' . $user_info->name . ' ' . ($user_info->last_name ?? '') . '</span> and it is autoassigned at ' . $date_div;
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

                    $extract = array(
                        'rm_name' => $user_info->name,
                        'message' => $message,
                        'additional_information' => '',
                        'company_name' => $company->site_name,
                        'subject' => $title,

                    );

                    $ins_mail = array(
                        'type' => 'Deal',
                        'type_id' => $deal_id,
                        'email_type' => 'general_task',
                        'params' => serialize($extract),
                        'to' => $user_info->email ?? 'duraibytes@gmail.com'
                    );
                }
            }
        }
        if (!empty($ins)) {
            if (automation('New Deal Addition', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('New Deal Addition', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }

    public static function send_deal_activity_notification($activity_id, $assigned_to = '', $update = '')
    {
        $company = CompanySettings::find(1);
        $lead_order_info = DB::table('deal_orders')->get();
        $title = 'New Deal Activity Added';
        if (!empty($update)) {
            $title = 'Changes Made on Deal Activity';
        }
        $act_info = Activity::find($activity_id);

        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';
        if ($assigned_to) {

            if (!empty($update)) {
                $message = 'Activity ' . $act_info->subject . ' has made some changes please view to see changes. Changes made by <span class="text-info">' . Auth::user()->name . ' ' . (Auth::user()->last_name ?? '') . '</span> at ' . $date_div;
            } else {
                $message = 'Activity ' . $act_info->subject . ' has assigned to <span class="text-success">' . $act_info->user->name . '</span> created by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;
            }

            $user_info = User::find($act_info->deal->assigned_to ?? $assigned_to);

            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'deal-activity',
                'url' => route('deals.view', ['id' => $act_info->deal_id]),
                'type_id' => $activity_id,
                'user_id' => $act_info->deal->assigned_to ?? $assigned_to,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );

            $extract = array(
                'rm_name' => $user_info->name,
                'message' => $message,
                'additional_information' => '',
                'company_name' => $company->site_name,
                'subject' => $title,

            );

            $ins_mail = array(
                'type' => 'Activity',
                'type_id' => $activity_id,
                'email_type' => 'general_task',
                'params' => serialize($extract),
                'to' => $user_info->email ?? 'duraibytes@gmail.com'
            );

            if (isset($act_info->deal->assigned_by) && !empty($act_info->deal->assigned_by)) {
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

                $extract = array(
                    'rm_name' => $user_info->name,
                    'message' => $message,
                    'additional_information' => '',
                    'company_name' => $company->site_name,
                    'subject' => $title,

                );

                $ins_mail[] = array(
                    'type' => 'Activity',
                    'type_id' => $activity_id,
                    'email_type' => 'general_task',
                    'params' => serialize($extract),
                    'to' => $user_info->email ?? 'duraibytes@gmail.com'
                );
            }
        } else {
            if (isset($lead_order_info) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {

                    $user_info = User::find($item->user_id);
                    if (!empty($update)) {
                        $message = 'Activity ' . $act_info->subject . ' has made some changes please view to see changes. Changes made by <span class="text-info">' . Auth::user()->name . ' ' . (Auth::user()->last_name ?? '') . '</span> at ' . $date_div;
                    } else {
                        $message = 'Activity ' . $act_info->subject . ' has assigned to <span class="text-success">' . $act_info->user->name . '</span> created by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;
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

                    $extract = array(
                        'rm_name' => $user_info->name,
                        'message' => $message,
                        'additional_information' => '',
                        'company_name' => $company->site_name,
                        'subject' => $title,

                    );

                    $ins_mail[] = array(
                        'type' => 'Activity',
                        'type_id' => $activity_id,
                        'email_type' => 'general_task',
                        'params' => serialize($extract),
                        'to' => $user_info->email ?? 'duraibytes@gmail.com'
                    );
                }
            }
        }
        if (!empty($ins)) {
            if (automation('Activity on all Deals', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('Activity on all Deals', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }

    public static function send_deal_activity_delete_notification($activity_id, $deal_id)
    {
        $company = CompanySettings::find(1);
        $deal_order_info = DB::table('deal_orders')->get();
        $act_info = Activity::find($activity_id);
        $deal_info = Deal::find($deal_id);
        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';

        $title = 'Deal Activity has been Deleted';
        $message = 'Activity ' . $act_info->subject . ' has been deleted by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;

        if (isset($deal_info->assigned_to) && !empty($deal_info->assigned_to)) {
            $user_info = User::find($deal_info->assigned_to);
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

            $extract = array(
                'rm_name' => $user_info->name,
                'message' => $message,
                'additional_information' => '',
                'company_name' => $company->site_name,
                'subject' => $title,

            );

            $ins_mail = array(
                'type' => 'Activity',
                'type_id' => $activity_id,
                'email_type' => 'general_task',
                'params' => serialize($extract),
                'to' => $user_info->email ?? 'duraibytes@gmail.com'
            );

            if (isset($act_info->deal->assigned_by) && !empty($act_info->deal->assigned_by)) {
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

                $extract = array(
                    'rm_name' => $user_info->name,
                    'message' => $message,
                    'additional_information' => '',
                    'company_name' => $company->site_name,
                    'subject' => $title,

                );

                $ins_mail[] = array(
                    'type' => 'Activity',
                    'type_id' => $activity_id,
                    'email_type' => 'general_task',
                    'params' => serialize($extract),
                    'to' => $user_info->email ?? 'duraibytes@gmail.com'
                );
            }
        } else {
            if (isset($deal_order_info) && !empty($deal_order_info)) {
                foreach ($deal_order_info as $item) {
                    $user_info = User::find($item->user_id);
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

                    $extract = array(
                        'rm_name' => $user_info->name,
                        'message' => $message,
                        'additional_information' => '',
                        'company_name' => $company->site_name,
                        'subject' => $title,

                    );

                    $ins_mail = array(
                        'type' => 'Activity',
                        'type_id' => $activity_id,
                        'email_type' => 'general_task',
                        'params' => serialize($extract),
                        'to' => $user_info->email ?? 'duraibytes@gmail.com'
                    );
                }
            }
        }

        if (!empty($ins)) {
            if (automation('Activity on all Deals', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('Activity on all Deals', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }


        return true;
    }

    public static function send_deal_activity_done_notification($activity_id, $deal_id)
    {
        $company = CompanySettings::find(1);
        $deal_order_info = DB::table('deal_orders')->get();
        $title = 'Deal Activity has been Done';

        $act_info = Activity::find($activity_id);
        $deal_info = Deal::find($deal_id);

        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';
        if (isset($deal_info->assigned_to) && !empty($deal_info->assigned_to)) {

            $message = 'Activity ' . $act_info->subject . ' has been completed by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;
            $user_info = User::find($deal_info->assigned_to);
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

            $extract = array(
                'rm_name' => $user_info->name,
                'message' => $message,
                'additional_information' => '',
                'company_name' => $company->site_name,
                'subject' => $title,

            );

            $ins_mail = array(
                'type' => 'Activity',
                'type_id' => $activity_id,
                'email_type' => 'general_task',
                'params' => serialize($extract),
                'to' => $user_info->email ?? 'duraibytes@gmail.com'
            );

            if (isset($act_info->deal->assigned_by) && !empty($act_info->deal->assigned_by)) {
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

                $extract = array(
                    'rm_name' => $user_info->name,
                    'message' => $message,
                    'additional_information' => '',
                    'company_name' => $company->site_name,
                    'subject' => $title,

                );

                $ins_mail[] = array(
                    'type' => 'Activity',
                    'type_id' => $activity_id,
                    'email_type' => 'general_task',
                    'params' => serialize($extract),
                    'to' => $user_info->email ?? 'duraibytes@gmail.com'
                );
            }
        } else {
            if (isset($deal_order_info) && !empty($deal_order_info)) {
                foreach ($deal_order_info as $item) {
                    $user_info = User::find($item->user_id);
                    $message = 'Activity ' . $act_info->subject . ' has been completed by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;

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

                    $extract = array(
                        'rm_name' => $user_info->name,
                        'message' => $message,
                        'additional_information' => '',
                        'company_name' => $company->site_name,
                        'subject' => $title,

                    );

                    $ins_mail[] = array(
                        'type' => 'Activity',
                        'type_id' => $activity_id,
                        'email_type' => 'general_task',
                        'params' => serialize($extract),
                        'to' => $user_info->email ?? 'duraibytes@gmail.com'
                    );
                }
            }
        }
        if (!empty($ins)) {
            if (automation('Activity on all Deals', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('Activity on all Deals', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }

    public static function send_deal_stage_notification($deal_id, $stage_id)
    {
        $deal_order_info = DB::table('deal_orders')->get();
        $title = 'Deal Stage has been Completed';

        $deal_info = Deal::find($deal_id);
        $deal_stage_info = DealStage::find($deal_info->current_stage_id);
        $new_stage_info = DealStage::find($stage_id);

        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';
        $message = 'Deal Stage ' . $deal_stage_info->stages . ' has been completed by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;

        if (isset($deal_info->assigned_to) && !empty($deal_info->assigned_to)) {

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

            $user_info = User::find($deal_info->assigned_to);

            $extract = array(
                'rm_name' => $user_info->name,
                'message' => $message,
                'name' => $deal_info->customer->first_name,
                'mobile_no' => $deal_info->customer->mobile_no,
                'email' => $deal_info->customer->email,
                'city' => $deal_info->customer->address ?? 'N/A',
                'source' => 'N/A',

            );

            $ins_mail = array(
                'type' => 'deal',
                'type_id' => $deal_id,
                'email_type' => 'stage_completed',
                'params' => serialize($extract),
                'to' => $user_info->email ?? 'duraibytes@gmail.com'
            );

            if (isset($deal_info->assigned_by) && !empty($deal_info->assigned_by)) {
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

                $extract = array(
                    'rm_name' => $user_info->name,
                    'message' => $message,
                    'name' => $deal_info->customer->first_name,
                    'mobile_no' => $deal_info->customer->mobile_no,
                    'email' => $deal_info->customer->email,
                    'city' => $deal_info->customer->address ?? 'N/A',
                    'source' => 'N/A',

                );

                $ins_mail[] = array(
                    'type' => 'deal',
                    'type_id' => $deal_id,
                    'email_type' => 'stage_completed',
                    'params' => serialize($extract),
                    'to' => $user_info->email ?? 'duraibytes@gmail.com'
                );
            }
        } else {
            if (isset($deal_order_info) && !empty($deal_order_info)) {
                foreach ($deal_order_info as $item) {
                    $user_info = User::find($item->user_id);

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

                    $extract = array(
                        'rm_name' => $user_info->name,
                        'message' => $message,
                        'name' => $deal_info->customer->first_name,
                        'mobile_no' => $deal_info->customer->mobile_no,
                        'email' => $deal_info->customer->email,
                        'city' => $deal_info->customer->address ?? 'N/A',
                        'source' => 'N/A',

                    );

                    $ins_mail[] = array(
                        'type' => 'deal',
                        'type_id' => $deal_id,
                        'email_type' => 'stage_completed',
                        'params' => serialize($extract),
                        'to' => $user_info->email ?? 'duraibytes@gmail.com'
                    );
                }
            }
        }
        if (!empty($ins)) {
            if (automation('Deal stage changed', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('Deal stage changed', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }

    public static function send_deal_winLoss_notification($deal_id, $status)
    {
        $deal_order_info = DB::table('deal_orders')->get();
        $deal_info = Deal::find($deal_id);

        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';
        if ($status == 2) {
            $title = 'Deal has won';
            $accepted_or_rejected = 'Accepted';
            $message = 'Deal has won by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;
        } else if ($status == 3) {
            $title = 'Deal has lost';
            $accepted_or_rejected = 'Rejected';

            $message = 'Deal has lost by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;
        } else if ($status == 1) {
            $title = 'Deal has Reopened';
            $accepted_or_rejected = 'Reopened';

            $message = 'Deal has reopened by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;
        }

        if (isset($deal_info->assigned_to) && !empty($deal_info->assigned_to)) {

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
            $user_info = User::find($deal_info->assigned_to);

            $extract = array(
                'rm_name' => $user_info->name,
                'message' => $message,
                'name' => $deal_info->customer->first_name,
                'mobile_no' => $deal_info->customer->mobile_no,
                'email' => $deal_info->customer->email,
                'city' => $deal_info->customer->address ?? 'N/A',
                'source' => 'N/A',
                'accepted_or_rejected' => $accepted_or_rejected,
                'reaction' => $accepted_or_rejected,
                'deal' => $deal_info->deal_title,

            );

            $ins_mail = array(
                'type' => 'deal',
                'type_id' => $deal_id,
                'email_type' => 'deal_won/loss',
                'params' => serialize($extract),
                'to' => $user_info->email ?? 'duraibytes@gmail.com'
            );

            if (isset($deal_info->assigned_by) && !empty($deal_info->assigned_by)) {
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

                $extract = array(
                    'rm_name' => $user_info->name,
                    'message' => $message,
                    'name' => $deal_info->customer->first_name,
                    'mobile_no' => $deal_info->customer->mobile_no,
                    'email' => $deal_info->customer->email,
                    'city' => $deal_info->customer->address ?? 'N/A',
                    'source' => 'N/A',
                    'accepted_or_rejected' => $accepted_or_rejected,
                    'deal' => $deal_info->deal_title,
                    'reaction' => $accepted_or_rejected,

                );

                $ins_mail[] = array(
                    'type' => 'deal',
                    'type_id' => $deal_id,
                    'email_type' => 'deal_won/loss',
                    'params' => serialize($extract),
                    'to' => $user_info->email ?? 'duraibytes@gmail.com'
                );
            }
        } else {
            if (isset($deal_order_info) && !empty($deal_order_info)) {
                foreach ($deal_order_info as $item) {

                    $user_info = User::find($item->user_id);
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

                    $extract = array(
                        'rm_name' => $user_info->name,
                        'message' => $message,
                        'name' => $deal_info->customer->first_name,
                        'mobile_no' => $deal_info->customer->mobile_no,
                        'email' => $deal_info->customer->email,
                        'city' => $deal_info->customer->address ?? 'N/A',
                        'source' => 'N/A',
                        'accepted_or_rejected' => $accepted_or_rejected,
                        'deal' => $deal_info->deal_title,
                        'reaction' => $accepted_or_rejected,


                    );

                    $ins_mail[] = array(
                        'type' => 'deal',
                        'type_id' => $deal_id,
                        'email_type' => 'deal_won/loss',
                        'params' => serialize($extract),
                        'to' => $user_info->email ?? 'duraibytes@gmail.com'
                    );
                }
            }
        }
        if (!empty($ins)) {
            if (automation('Deal won/lose', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('Deal won/lose', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }

    public static function send_deal_delete_notification($deal_id)
    {

        $deal_order_info = DB::table('deal_orders')->get();
        $company = CompanySettings::find(1);
        $deal_info = Deal::find($deal_id);

        $title = 'Deal Deleted';
        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';

        $message = 'Deal ' . $deal_info->deal_title . ' has been deleted by <span class="text-success">' . Auth::user()->name . ' ' . (Auth::user()->last_name ?? '') . '</span> at ' . $date_div;

        if (isset($deal_info->assigned_to) && !empty($deal_info->assigned_to)) {
            $user_info = User::find($deal_info->assigned_to);
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

            $extract = array(
                'rm_name' => $user_info->name,
                'message' => $message,
                'additional_information' => '',
                'company_name' => $company->site_name,
                'subject' => $title,

            );

            $ins_mail = array(
                'type' => 'Deal',
                'type_id' => $deal_id,
                'email_type' => 'general_task',
                'params' => serialize($extract),
                'to' => $user_info->email ?? 'duraibytes@gmail.com'
            );

            if (isset($deal_info->assigned_by) && !empty($deal_info->assigned_by)) {
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

                $extract = array(
                    'rm_name' => $user_info->name,
                    'message' => $message,
                    'additional_information' => '',
                    'company_name' => $company->site_name,
                    'subject' => $title,

                );

                $ins_mail[] = array(
                    'type' => 'Deal',
                    'type_id' => $deal_id,
                    'email_type' => 'general_task',
                    'params' => serialize($extract),
                    'to' => $user_info->email ?? 'duraibytes@gmail.com'
                );
            }
        } else {
            if (isset($deal_order_info) && !empty($deal_order_info)) {
                foreach ($deal_order_info as $item) {
                    $user_info = User::find($item->user_id);
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

                    $extract = array(
                        'rm_name' => $user_info->name,
                        'message' => $message,
                        'additional_information' => '',
                        'company_name' => $company->site_name,
                        'subject' => $title,
                    );

                    $ins_mail[] = array(
                        'type' => 'Deal',
                        'type_id' => $deal_id,
                        'email_type' => 'general_task',
                        'params' => serialize($extract),
                        'to' => $user_info->email ?? 'duraibytes@gmail.com'
                    );
                }
            }
        }
        if (!empty($ins)) {
            if (automation('Activity on all Deals', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('Activity on all Deals', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }

    public static function send_activity_status_change_notification($activity_id)
    {
        $company = CompanySettings::find(1);

        $lead_order_info = DB::table('lead_orders')->get();
        $act_info = Activity::find($activity_id);
        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';

        $title = 'Activity status has been Changed';
        $message = 'Activity ' . $act_info->subject . ' status has been changed to ' . $act_info->statusAll->status_name . ' by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;
        $ins = [];
        $ins_mail = [];
        if ($act_info->added_by == $act_info->user_id) {
            $user_info = User::find($act_info->added_by);
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

            $extract = array(
                'rm_name' => $user_info->name,
                'message' => $message,
                'additional_information' => '',
                'company_name' => $company->site_name,
                'subject' => $title,

            );

            $ins_mail = array(
                'type' => 'Activity',
                'type_id' => $activity_id,
                'email_type' => 'general_task',
                'params' => serialize($extract),
                'to' => $user_info->email ?? 'duraibytes@gmail.com'
            );
        } else if ($act_info->added_by != $act_info->user_id) {
            $add_info = User::find($act_info->added_by);
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

            $extract = array(
                'rm_name' => $add_info->name,
                'message' => $message,
                'additional_information' => '',
                'company_name' => $company->site_name,
                'subject' => $title,

            );

            $ins_mail[] = array(
                'type' => 'Activity',
                'type_id' => $activity_id,
                'email_type' => 'general_task',
                'params' => serialize($extract),
                'to' => $add_info->email ?? 'duraibytes@gmail.com'
            );
            $user_info = User::find($act_info->user_id);

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

            $extract = array(
                'rm_name' => $user_info->name,
                'message' => $message,
                'additional_information' => '',
                'company_name' => $company->site_name,
                'subject' => $title,

            );

            $ins_mail[] = array(
                'type' => 'Activity',
                'type_id' => $activity_id,
                'email_type' => 'general_task',
                'params' => serialize($extract),
                'to' => $user_info->email ?? 'duraibytes@gmail.com'
            );
        }

        if (!empty($ins)) {
            if (automation('Activity on all Deals', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('Activity on all Deals', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }

    public static function send_deal_invoice_notification($invoice_id, $assigned_to = '', $update = '')
    {
        $company = CompanySettings::find(1);
        $lead_order_info = DB::table('deal_orders')->get();
        $title = 'Deal Invoice Added to Approval';

        $act_info = Invoice::find($invoice_id);

        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';
        if ($assigned_to) {

            $message = 'Invoice ' . $act_info->invoice_no . ' has sent for approval to <span class="text-success">' . $act_info->customer->first_name . '</span> sent by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;

            $user_info = User::find($act_info->deal->assigned_to ?? $assigned_to);

            $ins = array(
                'title' => $title,
                'message' => $message,
                'type' => 'deal-invoice',
                'url' => route('invoices'),
                'type_id' => $invoice_id,
                'user_id' => $act_info->deal->assigned_to ?? $assigned_to,
                'assigned_by' => null,
                'created_at' => date('Y-m-d H:i:s')
            );

            if (isset($act_info->deal->assigned_by) && !empty($act_info->deal->assigned_by)) {
                $user_info = User::find($act_info->deal->assigned_by);

                $ins[] = array(
                    'title' => $title,
                    'message' => $message,
                    'type' => 'deal-invoice',
                    'url' => route('invoices'),
                    'type_id' => $invoice_id,
                    'user_id' => $act_info->deal->assigned_by,
                    'assigned_by' => null,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }
        } else {
            if (isset($lead_order_info) && !empty($lead_order_info)) {
                foreach ($lead_order_info as $item) {

                    $user_info = User::find($item->user_id);
                    $message = 'Invoice ' . $act_info->invoice_no . ' has sent for approval to <span class="text-success">' . $act_info->customer->first_name . '</span> sent by <span class="text-info">' . Auth::user()->name . '</span> at ' . $date_div;


                    $ins[] = array(
                        'title' => $title,
                        'message' => $message,
                        'type' => 'deal-invoice',
                        'url' => route('invoices'),
                        'type_id' => $invoice_id,
                        'assigned_by' => Auth::id() ?? null,
                        'user_id' => $item->user_id,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                }
            }
        }
        if (!empty($ins)) {
            if (automation('Invoice Creation', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }

        return true;
    }

    public static function send_payment_received_notification($deal_id)
    {

        $deal_order_info = DB::table('deal_orders')->get();
        $company = CompanySettings::find(1);
        $deal_info = Deal::find($deal_id);

        $title = 'Payment Received';
        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';

        $message = 'Deal ' . $deal_info->deal_title . ' has been received payment successfully  at ' . $date_div;

        if (isset($deal_info->assigned_to) && !empty($deal_info->assigned_to)) {
            $user_info = User::find($deal_info->assigned_to);
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

            $extract = array(
                'rm_name' => $user_info->name,
                'message' => $message,
                'additional_information' => '',
                'company_name' => $company->site_name,
                'subject' => $title,

            );

            $ins_mail = array(
                'type' => 'Deal',
                'type_id' => $deal_id,
                'email_type' => 'general_task',
                'params' => serialize($extract),
                'to' => $user_info->email ?? 'duraibytes@gmail.com'
            );

            if (isset($deal_info->assigned_by) && !empty($deal_info->assigned_by)) {
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

                $extract = array(
                    'rm_name' => $user_info->name,
                    'message' => $message,
                    'additional_information' => '',
                    'company_name' => $company->site_name,
                    'subject' => $title,

                );

                $ins_mail[] = array(
                    'type' => 'Deal',
                    'type_id' => $deal_id,
                    'email_type' => 'general_task',
                    'params' => serialize($extract),
                    'to' => $user_info->email ?? 'duraibytes@gmail.com'
                );
            }
        } else {
            if (isset($deal_order_info) && !empty($deal_order_info)) {
                foreach ($deal_order_info as $item) {
                    $user_info = User::find($item->user_id);
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

                    $extract = array(
                        'rm_name' => $user_info->name,
                        'message' => $message,
                        'additional_information' => '',
                        'company_name' => $company->site_name,
                        'subject' => $title,
                    );

                    $ins_mail[] = array(
                        'type' => 'Deal',
                        'type_id' => $deal_id,
                        'email_type' => 'general_task',
                        'params' => serialize($extract),
                        'to' => $user_info->email ?? 'duraibytes@gmail.com'
                    );
                }
            }
        }
        if (!empty($ins)) {
            if (automation('Thanks mail for the payment received', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('Thanks mail for the payment received', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }

    public static function send_new_customer_notification($customer_id)
    {

        $users = User::all();
        $company = CompanySettings::find(1);
        $customer_info = Customer::find($customer_id);

        $title = 'New Customer Added';
        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';

        $message = 'Customer ' . $customer_info->first_name . ' has been added successfully by  <span class="text-info">' . Auth::user()->name . '</span> ' . $date_div;


        if (isset($users) && !empty($users)) {
            foreach ($users as $item) {
                $ins[] = array(
                    'title' => $title,
                    'message' => $message,
                    'type' => 'new-customer',
                    'url' => 'javascript:void(0);',
                    'type_id' => $customer_id,
                    'assigned_by' => null,
                    'user_id' => $item->id,
                    'created_at' => date('Y-m-d H:i:s')
                );

                $extract = array(
                    'rm_name' => $item->name,
                    'message' => $message,
                    'additional_information' => '',
                    'company_name' => $company->site_name,
                    'subject' => $title,
                );

                $ins_mail[] = array(
                    'type' => 'new-customer',
                    'type_id' => $customer_id,
                    'email_type' => 'general_task',
                    'params' => serialize($extract),
                    'to' => $item->email ?? 'duraibytes@gmail.com'
                );
            }
        }

        if (!empty($ins)) {
            if (automation('New Customer Addition', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('New Customer Addition', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }

    public static function send_new_organization_notification($company_id)
    {

        $users = User::all();
        $company = CompanySettings::find(1);
        $customer_info = Organization::find($company_id);

        $title = 'New Organization Added';
        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';

        $message = 'Organization ' . $customer_info->first_name . ' has been added successfully by  <span class="text-info">' . Auth::user()->name . '</span> ' . $date_div;


        if (isset($users) && !empty($users)) {
            foreach ($users as $item) {
                $ins[] = array(
                    'title' => $title,
                    'message' => $message,
                    'type' => 'new-organization',
                    'url' => 'javascript:void(0);',
                    'type_id' => $company_id,
                    'assigned_by' => null,
                    'user_id' => $item->id,
                    'created_at' => date('Y-m-d H:i:s')
                );

                $extract = array(
                    'rm_name' => $item->name,
                    'message' => $message,
                    'additional_information' => '',
                    'company_name' => $company->site_name,
                    'subject' => $title,
                );

                $ins_mail[] = array(
                    'type' => 'new-organization',
                    'type_id' => $company_id,
                    'email_type' => 'general_task',
                    'params' => serialize($extract),
                    'to' => $item->email ?? 'duraibytes@gmail.com'
                );
            }
        }

        if (!empty($ins)) {
            if (automation('New Organization Addition', 'is_notification_to_team')) {
                DB::table('notifications')->insert($ins);
            }
        }
        if (!empty($ins_mail)) {
            if (automation('New Organization Addition', 'is_mail_to_team')) {
                DB::table('send_mail')->insert($ins_mail);
            }
        }
        return true;
    }

    public static function sendKycVerificationInternal( $customer_document_id ){
        $document_info = CustomerDocument::find($customer_document_id);
        $user_info = User::where('is_dev', 1)->first();
        $company = CompanySettings::find(1);

        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';
        $title = 'Need Approval KYC Document';
        $message = 'Customer ' . $document_info->customer->first_name . ' has uploaded document '.$document_info->documentType->document_name.'  at ' . $date_div.' .';

        $ins = array(
            'title' => $title,
            'message' => $message,
            'type' => 'kyc-approval',
            'url' => 'javascript:void(0);',
            'type_id' => $customer_document_id,
            'user_id' => $user_info->id,
            'assigned_by' => null,
            'created_at' => date('Y-m-d H:i:s')
        );

        $extract = array(
            'rm_name' => $user_info->name,
            'message' => $message,
            'additional_information' => '',
            'company_name' => $company->site_name,
            'subject' => $title,

        );

        $ins_mail = array(
            'type' => 'Kyc Approval',
            'type_id' => $customer_document_id,
            'email_type' => 'general_task',
            'params' => serialize($extract),
            'to' => $user_info->email ?? 'duraibytes@gmail.com'
        );

        if (!empty($ins)) {
            DB::table('notifications')->insert($ins);
        }
        if (!empty($ins_mail)) {
            DB::table('send_mail')->insert($ins_mail);
        }
        return true;
    }

    public static function sendDocumentStatusCustomer( $customer_id, $customer_document_id, $status ){
        $document_info = CustomerDocument::find($customer_document_id);
        $customer_info = Customer::find($customer_id);
        $company = CompanySettings::find(1);

        $date_div = '<strong class="text-primary">' . date('d M Y h:i A') . '</strong>';
        $title = 'Document '.$status;
        $message = $document_info->documentType->document_name.' Document has been '.$status.' by '.auth()->user()->name.'  at ' . $date_div.' . Please login to see Document status';

        $extract = array(
            'rm_name' => $customer_info->first_name.' '.$customer_info->last_name,
            'message' => $message,
            'additional_information' => '',
            'company_name' => $company->site_name,
            'subject' => $title,

        );

        $ins_mail = array(
            'type' => 'Kyc Approval',
            'type_id' => $customer_document_id,
            'email_type' => 'general_task',
            'params' => serialize($extract),
            'to' => $customer_info->email ?? 'duraibytes@gmail.com'
        );
       
        if (!empty($ins_mail)) {
            DB::table('send_mail')->insert($ins_mail);
        }
        return true;
    }
}