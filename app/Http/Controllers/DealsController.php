<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Lead;
use App\Models\User;
use App\Models\Customer;
use App\Models\DealStage;
use App\Models\Note;
use App\Models\Activity;

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
    public function show(Request $request)
    {
        return view('crm.deals.show');
    }

    public function add_edit(Request $request) {
        if (! $request->ajax()) {
            return response('Forbidden.', 403);
        }
        $id = $request->id;
        $modal_title = 'Add Deal';
        $stage = DealStage::orderBy('order_by', 'asc')->get();

        if( isset( $id ) && !empty($id) ) {
            $info = Lead::find($id);
            $modal_title = 'Update Deal';
        }
        $params = ['modal_title' => $modal_title, 'id' => $id ?? '', 'info' => $info ?? '', 'stage' => $stage ?? ''];
        return view('crm.deals.add_edit', $params);
       
    }
}
