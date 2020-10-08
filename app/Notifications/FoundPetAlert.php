<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FoundPetAlert extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type, $state, $post_id)
    {
        $this->type = $type;
        $this->state = $state;
        $this->post_id = $post_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via()
    {
        return ['mail', 'database'];
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
                    ->greeting('Alert: New Found Pets!')
                    ->line('A found ' . $this->type . ' was just posted in ' . $this->state .'.')
                    ->action('View the Post', url('/forum/details/'.$this->post_id))
                    ->line('Thanks for using PetSpotter. We\'re keeping an eye out for more found pet posts.');
    }

//    public function toDatabase($notifiable)
//    {
//        return [
//            'state' => 'state',
//            'type' => 'type',
//            'count' => 'count'
//        ];
//    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'state' => $this->state,
            'type' => $this->type,
            'id' => $this->post_id
        ];
    }
}
