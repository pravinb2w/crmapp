<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplates;
use App\Mail\TestEmail;

class EmailTemplateController extends Controller
{
    public function index()
    {
        $data   = EmailTemplates::paginate(5);
        $email_count = EmailTemplates::count();
        return view('crm.utilities.email_template.index', compact('data', 'email_count'));
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

        return redirect()->route('email.index')->with('success','Mail Created successfully!');
    }

    public function edit($id)
    {
        $data   = EmailTemplates::findOrFail($id);

        // $extract = array('name' => 'Durairaj', 'app_name' => 'Crm App', 'unsbusribe_link' => 'Unsubscribe','company_address' => 'Durairaj Testing email of the content');
        // $templateMessage = $data->content;
        // $templateMessage = str_replace("{","",addslashes($templateMessage));
        // $templateMessage = str_replace("}","",$templateMessage);
        // extract($extract);
        // eval("\$templateMessage = \"$templateMessage\";");
        
        // $body = [
        //     'content' => $templateMessage
        // ];
        // $send_mail = new TestEmail($body);
        // return $send_mail->render();
        // Mail::to($info->customer->emails ?? 'durai@yopmail.com')->send($send_mail);

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

        return redirect()->route('email.index')->with('success','Mail Updated successfully!');
    }

    public function delete($id)
    {
        EmailTemplates::find($id)->delete();
        return redirect()->route('email.index')->with('success','Mail Deleted successfully!');
    }
}
