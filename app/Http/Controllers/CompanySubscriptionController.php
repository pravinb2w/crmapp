<?php

namespace App\Http\Controllers;

use App\Models\CompanySubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;

class CompanySubscriptionController extends Controller
{
    public function index(Type $var = null)
    {
        $params = array('btn_name' => 'Company Subscriptions', 'btn_fn_param' => 'company-subscriptions');
        return view('crm.company_subscription.index', $params);
    }
}
