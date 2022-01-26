<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Type $var = null)
    {
        return view('crm.user.index');
    }
}
