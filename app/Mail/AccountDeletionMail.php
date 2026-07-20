<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountDeletionMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $confirmUrl,
    ) {}

    public function build(): self
    {
        return $this
            ->subject('Confirme a exclusão da sua conta — LivroNet')
            ->view('emails.account-deletion')
            ->with([
                'confirmUrl' => $this->confirmUrl,
            ]);
    }
}
