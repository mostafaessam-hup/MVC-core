<?php

namespace App\Base\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Jiovani',
        );
    }
    public function content()
    {
        return new Content(
            view: 'mail.otp',
            with: $this->data,
        );
    }

    public function attachments()
    {
        return [];
    }
}
