<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $verificationUrl,
        public ?string $userName = null,
    ) {}

    public function build(): self
    {
        return $this
            ->subject('Confirme seu e-mail — LivroNet')
            ->view('emails.verify')
            ->with([
                'verificationUrl' => $this->verificationUrl,
                'userName' => $this->userName,
            ]);
    }
}
