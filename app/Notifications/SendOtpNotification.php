<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendOtpNotification extends Notification
{
    use Queueable;
    protected $user;
    protected $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $otp)
    {
        $this->otp = $otp;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hi '.$this->user->user_name)
            ->subject(__('Your account created in ').env('APP_NAME',""))
            ->line(__('Welcome to the Tribe'))
            ->line('Please verify yourself before you proceed.')
            ->line(__('Veirification Code: ').": ".$this->otp)
            ->line('Thank you for using our application!');
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
            //
        ];
    }
}
