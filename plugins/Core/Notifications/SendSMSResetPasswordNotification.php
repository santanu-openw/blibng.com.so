<?php

namespace Zix\Core\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSMSResetPasswordNotification extends Notification
{
    public $pin_code;

    /**
     * Create a new notification instance.
     *
     * @param $pin_code
     */
    public function __construct($pin_code)
    {
        $this->pin_code = $pin_code;
    }

    /**
     * Get the notification channels.
     *
     * @param  mixed $notifiable
     * @return array|string ['mail', 'database', 'slack', 'nexmo']
     */
    public function via($notifiable)
    {
        return ['nexmo'];
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content('Your Pin Core is: '. $this->pin_code);
    }
}
