<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BulkPdfImport extends Controller
{
    public function index(Request $request)
    {
        return view('crm.utilities.bulk_import.index');
    }
}
