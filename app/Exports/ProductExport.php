<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductExport implements FromView
{

    public function view(): View
    {
        $details = Product::all();
        return view('crm.exports.product_excel', [
            'details' => $details
        ]);
    }
}