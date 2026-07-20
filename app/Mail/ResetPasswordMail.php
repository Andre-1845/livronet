<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $resetUrl,
        public ?string $userName = null,
        public int $expireMinutes = 60,
    ) {}

    public function build(): self
    {
        return $this
            ->subject('Redefinição de senha — LivroNet')
            ->view('emails.reset-password')
            ->with([
                'resetUrl' => $this->resetUrl,
                'userName' => $this->userName,
                'expireMinutes' => $this->expireMinutes,
            ]);
    }
}
