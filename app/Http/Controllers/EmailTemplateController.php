<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\EmailTemplates;
use App\Mail\TestEmail;
use CommonHelper;
use Mail;
use Illuminate\Support\Facades\Http;


class EmailTemplateController extends Controller
{
    public $companyCode;

    public function __construct(Request $request)
    {
        $this->companyCode = $request->segment(1);
    }

    public function index()
    {
        $data   = EmailTemplates::paginate(10);
        $email_count = EmailTemplates::count();
        return view('crm.utilities.email_template.index', compact('data', 'email_count'));
    }

    public function create()
    {
        $email_type = config('constant.email_type');
        return view('crm.utilities.email_template.create', ['email_type' => $email_type]);
    }

    public function store(Request $request)
    {
        $valid   = [
            'title'      => ['required', 'string', 'max:255'],
            'email_type' => ['required', 'string', 'max:255', 'unique:email_templates,email_type'],
            'content' => ['required']
        ];

        //Validate the product
        $validator                     = Validator::make($request->all(), $valid);

        if ($validator->passes()) {
            EmailTemplates::create([
                'title' => $request->title,
                'email_type' => $request->email_type,
                'subject' => $request->subject,
                'content' => $request->content,
                'created_by' => Auth()->user()->name,
            ]);
            return redirect()->route('email.index', $this->companyCode)->with('success', 'Mail Created successfully!');
        } else {
            return back()->withErrors($validator);
        }
    }

    public function edit($companyCode, $id)
    {
        $data   = EmailTemplates::findOrFail($id);
        // $response = Http::get('https://smshorizon.co.in/api/sendsms.php?user=stockphoenix&apikey=k5RWlTshSVTDa3rfETQ2&mobile=9551706025&message=Your Otp for Change Password -2025&senderid=STKPHX&type=txt&tid=1207161849508239572');

        // dd( $response );
        // CommonHelper::setMailConfig();
        // $extract = array('name' => 'Durairaj', 'app_name' => 'Crm App', 'unsbusribe_link' => 'Unsubscribe','company_address' => 'Durairaj Testing email of the content');
        // $templateMessage = $data->content;
        // $templateMessage = str_replace("{","",addslashes($templateMessage));
        // $templateMessage = str_replace("}","",$templateMessage);
        // extract($extract);
        // eval("\$templateMessage = \"$templateMessage\";");

        // $body = [
        //     'content' => $templateMessage
        // ];
        // $send_mail = new TestEmail($body, $data->title);
        // // return $send_mail->render();
        // Mail::to( 'durairaj@yopmail.com')->send($send_mail);

        $email_type = config('constant.email_type');

        return view('crm.utilities.email_template.edit', compact('data', 'email_type'));
    }

    public function update(Request $request, $id)
    {
        $valid   = [
            'title'      => ['required', 'string', 'max:255'],
            'email_type' => ['required', 'string', 'max:255', 'unique:email_templates,email_type,' . $id],
            'content' => ['required']
        ];

        //Validate the product
        $validator                     = Validator::make($request->all(), $valid);
        if ($validator->passes()) {
            EmailTemplates::find($id)->update([
                'title' => $request->title,
                'email_type' => $request->email_type,
                'subject' => $request->subject,
                'content' => $request->content,
                'created_by' => Auth()->user()->name,
            ]);
            return redirect()->route('email.index', $this->companyCode)->with('success', 'Mail Updated successfully!');
        } else {
            return back()->withErrors($validator);
        }
    }

    public function delete($companyCode, $id)
    {
        EmailTemplates::find($id)->delete();
        return redirect()->route('email.index', $this->companyCode)->with('success', 'Mail Deleted successfully!');
    }
}