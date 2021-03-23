<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $Token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($Token)
    {
         $this->Token = $Token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reset-pass');
    }
}
