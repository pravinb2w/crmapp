<?php

namespace App\Exports;

use App\Models\Organization;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrganizationExport implements FromView
{
    public function __construct()
    {
    }
    public function view(): View
    {
        $details = Organization::all();
        return view('crm.exports.company_excel', [
            'details' => $details
        ]);
    }
}