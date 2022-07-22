<?php

namespace App\Exports;

use App\Models\Note;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NotesExport implements FromView
{
    public function view(): View
    {
        $details = Note::all();
        return view('crm.exports.note_excel', [
            'details' => $details
        ]);
    }
}