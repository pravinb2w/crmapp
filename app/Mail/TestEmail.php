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
    public $details;

    public function __construct($details,)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (!empty($this->details['attachment'])) {
            $invoice_no = str_replace("/", "_", $this->details['attachment']);
            $file = $invoice_no . '.pdf';
            return $this->markdown('emails.test', $this->details['body'])->subject($this->details['subject'])->attach(public_path('/invoice/' . $file));
        } else {
            return $this->markdown('emails.test', $this->details['body'])->subject($this->details['subject']);
        }
    }
}