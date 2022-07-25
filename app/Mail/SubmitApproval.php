<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubmitApproval extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $body;
    public function __construct($body)
    {
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invoice_no = str_replace("/", "_", $this->body['invoice_no']);
        $file = $invoice_no . '.pdf';
        return $this->markdown('emails.SubmitApproval')->subject('Approval for Invoice')
            ->attach(public_path('/invoice/' . $file));
    }
}