<?php

namespace App\Exports;

use App\Models\LeadType;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LeadStageExport implements FromView
{
    public function __construct()
    {
    }
    public function view(): View
    {
        $details = LeadType::all();
        return view('crm.exports.leadstage_excel', [
            'details' => $details
        ]);
    }
}