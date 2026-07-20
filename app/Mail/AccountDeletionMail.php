<?php

namespace App\Mail;

use App\Models\EmailTemplate;
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
        $template = EmailTemplate::forKey('account_deletion');

        return $this
            ->subject($template->subject)
            ->view('emails.dynamic')
            ->with([
                'subject' => $template->subject,
                'body' => $template->body,
                'buttonText' => $template->button_text,
                'actionUrl' => $this->confirmUrl,
                'closingText' => $template->closing_text,
            ]);
    }
}
