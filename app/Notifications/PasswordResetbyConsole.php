<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetbyConsole extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $from_mail = config('mail.from.address', 'info@example.com');
        $from_name = config('mail.from.name', 'blog');
        
        return (new MailMessage)
                    ->from($from_mail, $from_name)
                    ->subject('Password Changed')
                    ->greeting('Hi , '.$notifiable->name.' ! ')
                    ->line('Your password is reset by system administrator.')
                    ->line('Kind regards, !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            // TODO: Check usage, implement if necassary
        ];
    }
}
