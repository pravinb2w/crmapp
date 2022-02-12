<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageType;

class CmsController extends Controller
{
    public function index()
    {
       
        $params = array('btn_name' => 'CMS Pages', 'btn_fn_param' => '', 'btn_href' => route('pages.add') );

        return view('crm.cms.index', $params);
    }

    public function add(Request $request, $id = '' ) {
        $params['id'] = $id;
        $params['pagetype'] = PageType::where('status', 1)->get();
        return view('crm.cms.add', $params);
    }
}
