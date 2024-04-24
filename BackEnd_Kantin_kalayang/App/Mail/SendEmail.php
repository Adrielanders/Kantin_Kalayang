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

        $namaPemilik = session('namaPemilik');
        $email = session('email');
        $nomorTelepon = session('nomorTelepon');
        $KataSandi = session('KataSandi');
        $subject = "Your Registration is Accepted!!!";
        return $this->from('no-reply@pupr.co.id', 'No-reply')
        ->subject($subject)
        ->view('emails.sendemail', compact('namaPemilik', 'email', 'nomorTelepon', 'KataSandi'));
    }
}