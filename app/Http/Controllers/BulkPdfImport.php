<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Imports\ImportCustomer;

class BulkPdfImport extends Controller
{
    public $companyCode;

    public function __construct(Request $request)
    {
        $this->companyCode = $request->segment(1);
    }
    
    public function index(Request $request)
    {
        return view('crm.utilities.bulk_import.index');
    }

    public function store(Request $request) {
        // dd( $request );
        $rules = array(
            'excel_file' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        // process the form
        if ($validator->fails()) 
        {
            return Redirect::to('bulk_import')->withErrors($validator);
        }else 
        {
            try {
                Excel::import(new ImportCustomer, $request->file('excel_file')->store('files'));
                return redirect()->back()->with('success', 'File Imported successfully');
            } catch (\Exception $e) {
                return redirect()->back()->with('error',  $e->getMessage());
            }
        } 
    }
}
