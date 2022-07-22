<?php

namespace App\Exports;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TaskExport implements FromView
{
    public function view(): View
    {
        $details = Task::all();
        return view('crm.exports.task_excel', [
            'details' => $details
        ]);
    }
}