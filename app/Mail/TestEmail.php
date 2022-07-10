<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $body;
    public $subject;
    public $attachment;
    public function __construct($body, $subject, $attachment = '')
    {
        $this->body = $body;
        $this->subject = $subject;
        $this->attachment = $attachment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (!empty($this->attachment)) {
            $invoice_no = str_replace("/", "_", $this->attachment);
            $file = $invoice_no . '.pdf';
            return $this->markdown('emails.test', $this->body)->subject($this->subject)->attach(public_path('/invoice/' . $file));
        } else {
            return $this->markdown('emails.test', $this->body)->subject($this->subject);
        }
    }
}