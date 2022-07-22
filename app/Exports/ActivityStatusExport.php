<?php

namespace App\Exports;

use App\Models\Status;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ActivityStatusExport implements FromView
{
    protected $type;
    public function __construct($type)
    {
        $this->type = $type;
    }
    public function view(): View
    {
        $details = Status::where('type', $this->type)->get();
        return view('crm.exports.activity_status_excel', [
            'details' => $details
        ]);
    }
}