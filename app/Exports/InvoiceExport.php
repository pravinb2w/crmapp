<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoiceExport implements FromView
{
    public function view(): View
    {
        $details = Invoice::all();
        return view('crm.exports.invoice_excel', [
            'details' => $details
        ]);
    } 
}
