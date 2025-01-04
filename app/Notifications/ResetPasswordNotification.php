<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;
    public $email;
    public $name;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $token, string $email, string $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = 'http://localhost:8000/password/reset/' . $this->token . '?email=' . $this->email;
        $expiration_time = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
        $greeting = 'Olá '. $this->name;

        return (new MailMessage)
            ->subject('Redefinição de senha')
            ->greeting($greeting)
            ->line('Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.')
            ->action('Redefinir senha', $url)
            ->line('Este link de redefinição de senha irá expirar em '. $expiration_time .' minutos.')
            ->line('Se você não solicitou uma redefinição de senha, nenhuma outra ação será necessária.')
            ->salutation('Até breve');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
