<?php

namespace App\Exports;

use App\Models\CompanySubscription;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CompanySubscriptionExport implements FromView
{
    public function view(): View
    {
        $details = CompanySubscription::all();
        return view('crm.exports.company_subscription_excel', [
            'details' => $details
        ]);
    }
}