<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class AccountDeletionRequested extends Notification
{
    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
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

        return (new MailMessage)
            ->subject('Confirme a exclusão da sua conta — LivroNet')
            ->greeting('Olá!')
            ->line('Recebemos um pedido para excluir sua conta no LivroNet.')
            ->line('Isso vai remover seus dados pessoais (nome, e-mail, telefone) e tirar seus livros da vitrine permanentemente.')
            ->line('Se foi você, confirme clicando no botão abaixo. Este link expira em 30 minutos.')
            ->action('Confirmar exclusão da conta', $url)
            ->line('Se você não pediu isso, pode ignorar este e-mail — nada será alterado na sua conta.');
    }
}
