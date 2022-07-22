<?php

namespace App\Exports;

use App\Models\Country;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CountryExport implements FromView
{
    public function view(): View
    {
        $details = Country::all();
        return view('crm.exports.country_excel', [
            'details' => $details
        ]);
    }
}