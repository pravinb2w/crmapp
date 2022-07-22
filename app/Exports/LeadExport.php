<?php

namespace App\Exports;

use App\Models\Lead;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LeadExport implements FromView
{
    public function __construct()
    {
    }
    public function view(): View
    {
        $details = Lead::all();
        return view('crm.exports.lead_excel', [
            'details' => $details
        ]);
    }
}