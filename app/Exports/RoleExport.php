<?php

namespace App\Exports;

use App\Models\Role;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RoleExport implements FromView
{
    public function view(): View
    {
        $details = Role::all();
        return view('crm.exports.role_excel', [
            'details' => $details
        ]);
    }
}