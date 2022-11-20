<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{
    public function view(): View
    {
        $details = User::where('is_dev', 0)->where('company_id', auth()->user()->company_id )->get();
        return view('crm.exports.user_excel', [
            'details' => $details
        ]);
    }
}