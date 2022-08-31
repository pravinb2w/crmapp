<?php

namespace App\Exports;

use App\Models\KycDocumentType;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DocumentTypesExport implements FromView
{
    public function view(): View
    {
        $details = KycDocumentType::all();
        return view('crm.exports.kyc_excel', [
            'details' => $details
        ]);
    } 
}
