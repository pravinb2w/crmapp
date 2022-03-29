<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplates;

class EmailTemplateController extends Controller
{
    public function index()
    {
        $data   = EmailTemplates::paginate(5);
        return view('crm.utilities.email_template.index', compact('data'));
    }

    public function create()
    {
        return view('crm.utilities.email_template.create');
    }

    public function store(Request $request)
    {
        EmailTemplates::create([
            'title' => $request->title,
            'subject' => $request->subject,
            'content' => $request->content,
            'created_by' => Auth()->user()->name,
        ]);

        return redirect()->route('email.index')->with('success','Mail To Created successfully!');
    }

    public function edit($id)
    {
        $data   = EmailTemplates::findOrFail($id);
        return view('crm.utilities.email_template.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        EmailTemplates::find($id)->update([
            'title' => $request->title,
            'subject' => $request->subject,
            'content' => $request->content,
            'created_by' => Auth()->user()->name,
        ]);

        return redirect()->route('email.index')->with('success','Mail To Updated successfully!');
    }

    public function delete($id)
    {
        EmailTemplates::find($id)->delete();
        return redirect()->route('email.index')->with('success','Mail To Deleted successfully!');
    }
}
