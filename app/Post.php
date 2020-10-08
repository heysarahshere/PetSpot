<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use Notifiable;

    protected $fillable = [
        'user_id',
        'contact_email',
        'author',
        'title',
        'content',
        'category',
        'address_address',
        'address_latitude',
        'address_longitude',
        'img',
        'state',
        'type',
        'event_date',
    ];


    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'post_id');
    }

    public function parentComments()
    {
        return $this->comments()->where('parent_id', 0);
    }

}
