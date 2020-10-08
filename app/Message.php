<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message',
        'user_id',
        'thread_id',
        'sender_deleted',
        'receiver_deleted'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function thread()
    {
        return $this->belongsTo('App\MessageThread', 'thread_id', 'id' );
    }


}
