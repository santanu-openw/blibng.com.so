<?php

namespace Zix\Core\Notifications;

use App\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeToBling extends Notification
{
    /**
     * @var User
     */
    public $user;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification channels.
     *
     * @param  mixed $notifiable
     * @return array|string ['mail', 'database', 'slack', 'nexmo']
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->greeting('Hello ' . $this->user->email)
            ->line('Welcome to Bling')
            ->line('Thank you for using our application!');
    }


}
