<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $params = array('btn_name' => 'Roles', 'btn_fn_param' => 'roles');
        return view('crm.customers.index', $params);
    }
}