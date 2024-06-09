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
        $resetUrl = url(config('app.url').route('password.reset', $this->token, false));

        return (new MailMessage)
            ->subject('Изменение Уведомления о Сбросе Пароля')
            ->greeting('Приветствуем!')
            ->line('Вы получили это письмо, потому что для вашей учетной записи был запрошен сброс пароля.')
            ->action('Сбросить Пароль', $resetUrl)
            ->line('Ссылка для сброса пароля истечет через 60 минут.')
            ->line('Если вы не запрашивали сброс пароля, дополнительные действия не требуются.')
            ->salutation('С Уважением, ваша команда');
    }
}
