<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class CustomResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Redefinição de Senha')
            ->greeting('Olá!')
            ->line('Recebemos uma solicitação de redefinição de senha para a sua conta.')
            ->action('Redefinir Senha', $url)
            ->line('Este link expirará em 60 minutos.')
            ->line('Se você não solicitou a redefinição, nenhuma ação é necessária.')
            ->salutation('Atenciosamente, Equipe do Sistema');
    }
}
