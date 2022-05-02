<?php

namespace App\Exports;

use App\Models\Deal;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportDealStarted implements FromView
{
    public function __construct($year = '')
    {
        $this->year = $year;
    }

    public function view(): View
    {
        if( isset($this->year) && !empty($this->year)) {
            $dates = explode("-", $this->year);
            $start_date = date('Y-m-d', strtotime($dates[0]));
            $end_date = date('Y-m-d', strtotime($dates[1]));

            $deals = Deal::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->get();
        } else {
            $deals = Deal::all();
        }
        return view('crm.exports.started', [
            'deals' => $deals
        ]);
    }
}
