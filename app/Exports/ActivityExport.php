<?php

namespace App\Exports;

use App\Models\Activity;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ActivityExport implements FromView
{

    public function view(): View
    {
        $details = Activity::all();
        return view('crm.exports.activity_excel', [
            'details' => $details
        ]);
    }
}