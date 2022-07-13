<?php

namespace App\Console\Commands;

use App\Helpers\CommonHelper;
use App\Jobs\SendMailJob;
use App\Mail\SubmitApproval;
use App\Mail\TestEmail;
use App\Models\EmailTemplates;
use App\Models\SendMail as ModelsSendMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:cronMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan commands to send mail every minutes based on database entries';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Set mail configuration
        CommonHelper::setMailConfig();
        $data = ModelsSendMail::all();

        if (isset($data) && !empty($data)) {
            foreach ($data as $item) {

                $econtent   = EmailTemplates::where('email_type', $item->email_type)->first();
                if ($item->email_type == 'invoice_approval') {
                    $extract = json_decode($item->params);

                    $send_mail = new SubmitApproval($extract);
                    // return $send_mail->render();
                    Mail::to($item->to ?? 'duraibytes@gmail.com')->send($send_mail);
                    // ModelsSendMail::find($item->id)->delete();
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
                            $message->to($to ?? 'duraibytes@gmail.com', 'Phoenix CRM')->subject($title ?? '');
                            $message->from('durairajnet@gmail.com', 'Phoenix CRM');
                        });

                        ModelsSendMail::find($item->id)->delete();
                    }
                }
            }
        }


        info('mail task running');
    }
}