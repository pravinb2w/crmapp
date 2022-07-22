<?php

namespace App\Exports;

use App\Models\Permission;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PermissionExport implements FromView
{
    public function view(): View
    {
        $details = Permission::all();
        return view('crm.exports.permission_excel', [
            'details' => $details
        ]);
    }
}