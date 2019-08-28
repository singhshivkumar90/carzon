<?php
declare(strict_types=1);

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class PasswordResetNotification extends Notification
{
    use Queueable;

    /**
     * Token to reset password
     *
     * @var $token
     */
    public $token;

    /**
     * @var User $user
     */
    public $user;

    /**
     * Create a new notification instance.
     *
     * @param $token
     * @param $user
     * @return void
     */
    public function __construct($user, $token)
    {
        $this->token = $token;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $urlToResetForm = config('app.url') . 'reset-password?email=' . urlencode($this->user->email) . '&token=' . $this->token;

        return (new MailMessage)
            ->subject(Lang::getFromJson('Reset Password Notification'))
            ->greeting(Lang::getFromJson("Hello $notifiable->fullname,"))
            ->line(Lang::getFromJson('You are receiving this email because we received a password reset request for your account.'))
            ->action(Lang::getFromJson('Reset Password'), $urlToResetForm)
            ->line(Lang::getFromJson('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.users.expire')]))
            ->line(Lang::getFromJson('If you did not request a password reset, no further action is required.'));
    }
}
