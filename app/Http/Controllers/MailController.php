<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CommonHelper;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendMailJob;
use App\Mail\TestEmail;
use App\Models\EmailTemplates;
use DB;

class MailController extends Controller
{
    public function sendMail()
    {
        try {
            //Set mail configuration
            CommonHelper::setMailConfig();

            $data   = EmailTemplates::where('email_type', 'new_registration')->first();
            $extract = array(
                'name' => 'Duriaraj',
                'password' => 20301020,
            );

            $templateMessage = $data->content;
            $templateMessage = str_replace("{", "", addslashes($templateMessage));
            $templateMessage = str_replace("}", "", $templateMessage);
            extract($extract);
            eval("\$templateMessage = \"$templateMessage\";");

            $body = [
                'content' => $templateMessage
            ];

            Mail::send('emails.test', $body, function ($message) {
                $message->to('duraibytes@gmail.com', 'Tutorials Point')->subject('Laravel Basic Testing Mail');
                $message->from('durairajnet@gmail.com', 'Durai bytes');
            });
            echo 'Test email sent successfully';
            // return redirect()->back()->with('success', 'Test email sent successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            // return redirect()->back()->withErrors($e->getMessage());
        }
    }
}

// $data   = EmailTemplates::where('email_type', 'new_registration')->first();
// CommonHelper::setMailConfig();

// $templateMessage = $data->content;
// $templateMessage = str_replace("{", "", addslashes($templateMessage));
// $templateMessage = str_replace("}", "", $templateMessage);
// extract($extract);
// eval("\$templateMessage = \"$templateMessage\";");

// $body = [
//     'content' => $templateMessage
// ];

// $send_mail = new TestEmail($body, $data->title ?? '');
// // return $send_mail->render();
// Mail::to($request->email ?? 'duraibytes@gmail.com')->send($send_mail);