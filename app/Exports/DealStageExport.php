<?php

namespace App\Exports;

use App\Models\DealStage;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealStageExport implements FromView
{
    public function __construct()
    {
    }
    public function view(): View
    {
        $details = DealStage::all();
        return view('crm.exports.deal_stage_excel', [
            'details' => $details
        ]);
    }
}