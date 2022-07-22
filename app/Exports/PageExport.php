<?php

namespace App\Exports;

use App\Models\LandingPages;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PageExport implements FromView
{
    public function __construct()
    {
    }
    public function view(): View
    {
        $details = LandingPages::all();
        return view('crm.exports.page_excel', [
            'details' => $details
        ]);
    }
}