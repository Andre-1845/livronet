<?php

namespace App\Mail;

use App\Models\EmailTemplate;
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
        $template = EmailTemplate::forKey('reset_password');

        $body = str_replace(
            [':name', ':expire_minutes'],
            [$this->userName ?? '', (string) $this->expireMinutes],
            $template->body
        );

        return $this
            ->subject($template->subject)
            ->view('emails.dynamic')
            ->with([
                'subject' => $template->subject,
                'body' => $body,
                'buttonText' => $template->button_text,
                'actionUrl' => $this->resetUrl,
                'closingText' => $template->closing_text,
            ]);
    }
}
