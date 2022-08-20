<?php

namespace App\Console\Commands;

use App\Helpers\CommonHelper;
use App\Jobs\SendMailJob;
use App\Mail\SubmitApproval;
use App\Mail\TestEmail;
use App\Models\CompanySettings;
use App\Models\EmailTemplates;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\SendMail as ModelsSendMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
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
        $company_info = CompanySettings::find(1);
        $from = $company_info->smtp_user;
        $data = ModelsSendMail::all();

        if (isset($data) && !empty($data)) {
            foreach ($data as $item) {

                $econtent   = EmailTemplates::where('email_type', $item->email_type)->first();
                if ($item->email_type == 'invoice_approval') {
                    $extract = (array)json_decode($item->params);
                    // Log::info($extract);
                    $to = $item->to;
                    $title = 'Approval waiting for Invoice';
                    $invoice_no = str_replace("/", "_", $extract['invoice_no']);
                    $file = $invoice_no . '.pdf';

                    $send_mail = new SubmitApproval($extract);
                    // return $send_mail->render();
                    Mail::to($to ?? 'durai@yopmail.com')->send($send_mail);
                    ModelsSendMail::find($item->id)->delete();
                } else {
                    if (isset($econtent) && !empty($econtent)) {

                        $extract = unserialize($item->params);
                        extract($extract);

                        $templateMessage = $econtent->content;
                        $templateMessage = str_replace("{", "", addslashes($templateMessage));
                        $templateMessage = str_replace("}", "", $templateMessage);
                        eval("\$templateMessage = \"$templateMessage\";");

                        $templateSubject = $econtent->subject;
                        $templateSubject = str_replace("{", "", addslashes($templateSubject));
                        $templateSubject = str_replace("}", "", $templateSubject);

                        eval("\$templateSubject = \"$templateSubject\";");

                        $body = [
                            'content' => $templateMessage
                        ];
                        $to = $item->to;
                        $title = $templateSubject;

                        if($item->email_type == 'success_payment') {
                            $order_id = $item->type_id;
                            $invoice_info = Invoice::where('order_no', $order_id)->first();
                            if( isset( $invoice_info ) && !empty( $invoice_info ) ){
                                $invoice_no = str_replace("/", "_", $invoice_info->invoice_no);
                                $file = $invoice_no . '.pdf';

                                Mail::send('emails.test', $body, function ($message) use ($to, $title, $from, $file) {
                                    $message->to($to ?? 'duraibytes@gmail.com', 'Phoenix CRM')->subject($title ?? '');
                                    $message->from($from, 'Phoenix CRM');
                                    $message->attach(public_path('/invoice/' . $file));
                                });
                            }
                            
                        } else {
                            Mail::send('emails.test', $body, function ($message) use ($to, $title, $from) {
                                $message->to($to ?? 'duraibytes@gmail.com', 'Phoenix CRM')->subject($title ?? '');
                                $message->from($from, 'Phoenix CRM');
                            });
                        }
                        ModelsSendMail::find($item->id)->delete();
                        
                    }
                }
            }
        }
        info('mail task running');
    }
}