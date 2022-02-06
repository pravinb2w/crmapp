<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;

class CustomerController extends Controller
{
    public function index()
    {
        $params = array('btn_name' => 'Customers', 'btn_fn_param' => 'customers');
        return view('crm.customers.index', $params);
    }

    public function add_edit(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Add Customer';
        if( isset( $id ) && !empty($id) ) {
            $info = Country::find($id);
            $modal_title = 'Update Customer';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? ''];
        return view('crm.customers.add_edit', $params);
        echo json_encode(['view' => $view]);
        return true;
    }
}