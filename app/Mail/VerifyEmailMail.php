<?php

namespace App\Mail;

use App\Models\EmailTemplate;
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
        $template = EmailTemplate::forKey('verify_email');

        return $this
            ->subject($template->subject)
            ->view('emails.dynamic')
            ->with([
                'subject' => $template->subject,
                'body' => str_replace(':name', $this->userName ?? '', $template->body),
                'buttonText' => $template->button_text,
                'actionUrl' => $this->verificationUrl,
                'closingText' => $template->closing_text,
            ]);
    }
}
