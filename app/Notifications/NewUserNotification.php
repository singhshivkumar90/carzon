<?php
declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class NewUserNotification extends Notification
{
    use Queueable;

    /**
     * @var $password
     */
    protected $password;

    /**
     * NewUserNotification constructor.
     *
     * @param $password
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * @param $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        $urlToLoginForm = config('app.url') . 'login';

        return (new MailMessage)
            ->subject(Lang::getFromJson('Welcome to Carzon'))
            ->greeting(Lang::getFromJson("Hello $notifiable->fullname,"))
            ->line(Lang::getFromJson('Your account has been successfully created.'))
            ->line(Lang::getFromJson('Below are the login credentials.'))
            ->line(Lang::getFromJson("Username:  $notifiable->email"))
            ->line(Lang::getFromJson("Password:  $this->password"))
            ->action(Lang::getFromJson('click here to login'), $urlToLoginForm);
    }
}
