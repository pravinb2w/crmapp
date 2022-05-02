<?php

namespace App\Exports;

use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportSale implements FromView
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

            $deals = Payment::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->get();
        } else {
            $deals = Payment::all();
        }
        return view('crm.exports.sale_excel', [
            'deals' => $deals
        ]);
    }
}
