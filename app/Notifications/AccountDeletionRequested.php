<?php

namespace App\Notifications;

use App\Mail\AccountDeletionMail;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class AccountDeletionRequested extends Notification
{
    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): AccountDeletionMail
    {
        // Link assinado, válido por 30 minutos — mesmo padrão usado na
        // verificação de e-mail. O hash do e-mail atual é conferido na
        // hora de confirmar, como camada extra (defesa em profundidade).
        $url = URL::temporarySignedRoute(
            'account.delete.confirm',
            now()->addMinutes(30),
            [
                'id' => $notifiable->id,
                'hash' => sha1($notifiable->email),
            ]
        );

        return (new AccountDeletionMail($url))->to($notifiable->email);
    }
}
