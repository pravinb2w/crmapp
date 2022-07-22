<?php

namespace App\Exports;

use App\Models\LeadSource;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LeadSourceExport implements FromView
{
    public function __construct()
    {
    }
    public function view(): View
    {
        $details = LeadSource::all();
        return view('crm.exports.leadsource_excel', [
            'details' => $details
        ]);
    }
}