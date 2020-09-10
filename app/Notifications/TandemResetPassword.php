<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;

class TandemResetPassword extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
        $this->queue = 'emails';
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        app()->setLocale($notifiable->preferred_language);

        return (new MailMessage)
            ->from('no-reply@isc.cvut.cz', config('app.name'))
            ->subject(__('tandem.index.heading') . ' – ' . __('tandem.passwords.password-reset'))
            ->greeting(__('tandem.passwords.email.greeting'))
            ->line(__('tandem.passwords.email.line-1'))
            ->action(__('tandem.passwords.email.action'), url(config('app.url').route('tandem.password.reset', $this->token, false)))
            ->line(__('tandem.passwords.email.line-2'))
            ->salutation(new HtmlString(__('tandem.passwords.email.salutation') . "<br />" . config('app.name')));
    }
}
