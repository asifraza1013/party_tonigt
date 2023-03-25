<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class InAppNotifications extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user;
    protected $detail;
    public function __construct($user, $detail)
    {
        $this->user = $user;
        $this->detail = $detail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
        Log::info('In notification-- '.json_encode($this->detail));
        if($this->detail->type == 3){
            return [
                'name' => $this->user->user_name,
                'is_follow' => true,
                'type' => $this->detail->type,
                'email' => $this->user->email,
                'notification' => $this->detail->detail,
                'f_user_id' => $this->detail->user_id,
                'user_name' => $this->detail->user_name,
                'user_image' => $this->detail->user_image,
            ];
        }else{
            return [
                'name' => $this->user->user_name,
                'email' => $this->user->email,
                'is_follow' => false,
                'type' => $this->detail->type,
                'notification' => $this->detail->detail,
                'post_id' => $this->detail->post_id,
                'post_name' => $this->detail->post_name,
                'post_image' => $this->detail->post_image,
                'liked_by' => !isset($this->detail->liked_by) ? null : $this->detail->liked_by,
                'purchased_by_image' => !isset($this->detail->purchased_by_image) ? null : $this->detail->purchased_by_image,
                'purchased_by' => !isset($this->detail->purchased_by) ? null : $this->detail->purchased_by,
                'liked_by_image' => !isset($this->detail->liked_by_image) ? null : $this->detail->liked_by_image,
            ];
        }
    }
}
