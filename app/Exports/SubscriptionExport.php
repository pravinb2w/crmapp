<?php

namespace App\Exports;

use App\Models\Subscription;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SubscriptionExport implements FromView
{
    public function view(): View
    {
        $details = Subscription::all();
        return view('crm.exports.subscription_excel', [
            'details' => $details
        ]);
    }
}