<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Jobs\SendMailJob;
use App\Mail\SubmitApproval;
use App\Mail\TestEmail;
use App\Models\EmailTemplates;
use App\Models\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CronController extends Controller
{
    public function sendMail(Request $request)
    {
        CommonHelper::setMailConfig();
        $data = SendMail::all();

        if (isset($data) && !empty($data)) {
            foreach ($data as $item) {

                $econtent   = EmailTemplates::where('email_type', $item->email_type)->first();
                if ($item->email_type == 'invoice_approval') {
                    $extract = json_decode($item->params);

                    $send_mail = new SubmitApproval($extract);
                    // return $send_mail->render();
                    Mail::to($item->to ?? 'duraibytes@gmail.com')->send($send_mail);
                    // SendMail::find($item->id)->delete();
                } else {
                    if (isset($econtent) && !empty($econtent)) {

                        $extract = unserialize($item->params);

                        $templateMessage = $econtent->content;
                        $templateMessage = str_replace("{", "", addslashes($templateMessage));
                        $templateMessage = str_replace("}", "", $templateMessage);
                        extract($extract);
                        eval("\$templateMessage = \"$templateMessage\";");

                        $body = [
                            'content' => $templateMessage
                        ];
                        $to = $item->to;
                        $title = $econtent->title;

                        Mail::send('emails.test', $body, function ($message) use ($to, $title) {
                            $message->to($to, 'Phoenix CRM')->subject($title ?? '');
                            $message->from('durairajnet@gmail.com', 'Durai bytes');
                        });

                        // SendMail::find($item->id)->delete();
                    }
                }
            }
        }
        echo "Mail send successfully !!";
    }
}