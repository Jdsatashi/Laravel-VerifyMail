<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPassNotify extends Mailable
{
    use Queueable, SerializesModels;

    protected array $data_user;
    public function __construct(array $data_user)
    {
        $this->data_user = $data_user;
    }

    public function build(){
        return $this->subject("Laravel app notify")->view('mail.mail_form')->with('data_user', $this->data_user);
    }
}
