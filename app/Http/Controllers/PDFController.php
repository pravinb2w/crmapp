<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\CompanySettings;
use DB;
use PDF;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $id = 10;
        $info = Invoice::find( $id );
        $company = CompanySettings::find(1);
        $taxable = DB::table('invoice_items')
                    ->join('products', 'invoice_items.product_id', '=', 'products.id')
                    ->select('products.hsn_no', 'invoice_items.qty','invoice_items.unit_price', DB::raw('(invoice_items.qty * invoice_items.unit_price) as price'), 'invoice_items.cgst', 'invoice_items.sgst', 'invoice_items.igst')
                    ->where('invoice_items.invoice_id', $id)
                    ->groupBy('products.hsn_no')
                    ->get();
        $data = [
            'info' => $info,
            'company' => $company,
            'taxable' => $taxable,
        ];
        // return view('myPDF', $data);
        $pdf = PDF::loadView('myPDF', $data);
    
        return $pdf->download('nicesnippets.pdf');
    }
}
