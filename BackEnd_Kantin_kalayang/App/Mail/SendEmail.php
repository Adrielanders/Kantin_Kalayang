<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $isSuccess;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@pupr.co.id', 'No-reply')
        ->subject('Your Registration is Accepted!!!')
        ->view('emails.sendemail');
    }
}