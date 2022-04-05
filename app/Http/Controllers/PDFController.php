<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to Nicesnippets.com',
            'date' => date('m/d/Y')
        ];
        // return view('myPDF', $data);
        $pdf = PDF::loadView('myPDF', $data);
    
        return $pdf->download('nicesnippets.pdf');
    }
}
