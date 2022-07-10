<?php

namespace App\Jobs;

use App\Helpers\CommonHelper;
use App\Mail\SubmitApproval;
use Mail;
use App\Mail\TestEmail;
use App\Models\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\SendMail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $details;
    public $timeout = 7200; // 2 hours
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $data = SendMail::all();
        CommonHelper::setMailConfig();
        if (isset($data) && !empty($data)) {
            foreach ($data as $item) {
                $econtent   = EmailTemplates::where('email_type', $item->email_type)->first();

                if ($item->email_type == 'invoice_approval') {
                    $extract = json_decode($item->params);

                    $send_mail = new SubmitApproval($extract);
                    // return $send_mail->render();
                    Mail::to($item->to ?? 'duraibytes@gmail.com')->send($send_mail);
                    SendMail::find($item->id)->delete();
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

                        $send_mail = new TestEmail($body, $econtent->title ?? '');
                        // return $send_mail->render();
                        Mail::to($item->to ?? 'duraibytes@gmail.com')->send($send_mail);

                        SendMail::find($item->id)->delete();
                    }
                }
            }
        }
    }
}