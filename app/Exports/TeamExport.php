<?php

namespace App\Exports;

use App\Models\Team;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TeamExport implements FromView
{
    public function view(): View
    {
        $details = Team::all();
        return view('crm.exports.team_excel', [
            'details' => $details
        ]);
    }
}