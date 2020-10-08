<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactMessage extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email, $reason, $name, $subject, $content)
    {
        $this->email = $email;
        $this->name = $name;
        $this->subject = $subject;
        $this->reason = $reason;
        $this->content = $content;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
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
                    ->greeting('Attention: Contact Message')
                    ->line($this->name . 'has requested to contact PetSpot regarding .'. $this->subject .'.')
                    ->action('Email:', url('mailto:'.$this->email))
                    ->line('Message: .'.$this->content);
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
            'email' => $this->email,
            'name' => $this->name,
            'subject' => $this->subject,
            'content' => $this->content,
            'reason' => $this->reason,
        ];
    }
}
