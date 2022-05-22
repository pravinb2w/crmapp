<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportForecast implements FromView
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
        } else {
            $start_date = date('Y-m-1');
            $end_date = date('Y-m-t');
        }

        $fore = Invoice::whereDate('due_date', '>=', $start_date)->whereDate('due_date', '<=', $end_date)->get();
        
        return view('crm.exports.forecast_excel', [
            'fore' => $fore
        ]);
    }
}
