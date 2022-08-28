<?php

namespace App\Exports;

use App\Models\Newsletter;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NewsletterExport implements FromView
{
    public function view(): View
    {
        $details = Newsletter::all();
        return view('crm.exports.invoice_excel', [
            'details' => $details
        ]);
    } 
}
