<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;
    public $notifications;
    public $info;
    public $user_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {

        $this->username = $user->userName;
        $this->user_id = $user->id;
        $this->info  = "New notification from {$user->userName}.";
        $this->notifications  =  count($user->unreadnotifications);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('message-sent');
//        return  ['notif_count.'.count($this->notifications)];
    }



}
