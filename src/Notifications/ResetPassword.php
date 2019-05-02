<?php
namespace XRA\LU\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param mixed $notifiable
     *
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        ///*
        return (new MailMessage())
            ->subject(Lang::getFromJson('Reset Password'))
            ->markdown('lu::notifications.email', ['subcopy' => 'subcopy']) 
            ->line(Lang::getFromJson('You are receiving this email because we received a password reset request for your account.'))
            ->action('Reset Password', url(route('password.reset', $this->token, false)))
            ->line(Lang::getFromJson('If you did not request a password reset, no further action is required.'));
        //*/
            /*
        $reset_password_url=url(route('password.reset', $this->token, false));
        return (new MailMessage())
            ->subject(Lang::getFromJson('Verify Email Address'))
            ->greeting('Hello!')
            ->view('lu::mail.reset_password',['reset_password_url'=>$reset_password_url])
        */
    }
}
