<?php

namespace App\Exports;

use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentExport implements FromView
{
    public function __construct()
    {
    }
    public function view(): View
    {
        $details = Payment::all();
        return view('crm.exports.payment_excel', [
            'details' => $details
        ]);
    }
}