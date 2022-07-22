<?php

namespace App\Exports;

use App\Models\Deal;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealExport implements FromView
{

    public function view(): View
    {
        $details = Deal::all();
        return view('crm.exports.deal_excel', [
            'details' => $details
        ]);
    }
}