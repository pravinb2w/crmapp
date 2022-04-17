<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\CompanySettings;
use App\Models\Customer;
use App\Models\Deal;


class PaymentController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Payments', 'btn_fn_param' => '', 'btn_href' => route('payments.add') );
        return view('crm.payments.index', $params);
    }

    public function add(Request $request) {
        $params[ 'title' ]  = 'Add Payment';
        return view( 'crm.payments.add', $params );
    }

    public function autocomplete_customer(Request $request) {
        
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $query              = $request->org;
        $list               = Customer::search( $query )
                                ->get();
        $params['list']     = $list;
        $params['query']    = $query;

        return view('crm.common._autocomplete_pay_customer', $params);
    }

    public function customer_deal_info(Request $request) {
        $customer_id = $request->customer_id;
        $deal_info = Deal::where('customer_id', $customer_id)->get();
        echo view('crm.payments._deal_select', ['info' => $deal_info ]);
    }
}
