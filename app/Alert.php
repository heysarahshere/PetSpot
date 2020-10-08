<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Alert extends Model
{
    use Notifiable;

    protected $fillable = [
        'user_id',
        'type',
        'state',
        'email',
        'img'
    ];


    public function user() {
        return $this->belongsTo('App\User');
    }

}
