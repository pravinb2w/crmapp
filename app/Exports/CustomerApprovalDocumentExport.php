<?php

namespace App\Exports;

use App\Models\CustomerDocument;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class CustomerApprovalDocumentExport implements FromView
{
    public function view(): View
    {
        $details = CustomerDocument::join('customers', 'customers.id', '=', 'customer_documents.customer_id')
        ->join('kyc_document_types', 'kyc_document_types.id', '=', 'customer_documents.document_id')
        ->get();
        return view('crm.exports.customer_document_approval', [
            'details' => $details
        ]);
    }
}
