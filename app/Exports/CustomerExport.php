<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomerExport implements FromView
{
    public function __construct()
    {
    }
    public function view(): View
    {
        $details = Customer::all();
        return view('crm.exports.customers_excel', [
            'details' => $details
        ]);
    }
}