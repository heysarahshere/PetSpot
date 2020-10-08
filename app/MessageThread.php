<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageThread extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'subject',
        'sender_deleted',
        'receiver_deleted'
    ];

    public function messages() {
        return $this->hasMany('App\Message', 'thread_id');
    }
    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id','id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id','id');
    }
}
