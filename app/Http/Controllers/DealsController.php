<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DealsController extends Controller
{
    public function index(Request $request)
    {
        return view('crm.deals.index');
    }
    public function create(Request $request)
    {
        return view('crm.deals.create');
    }
}
