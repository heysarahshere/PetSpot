<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'password',
        'profile_image',
        'userName',
        'firstName',
        'lastName',
        'userName',
        'email',
        'shipping_line1',
        'shipping_line2',
        'shipping_city',
        'shipping_state',
        'shipping_zip',
        'billingFirstName',
        'billingLastName',
        'billing_line1',
        'billing_line2',
        'billing_city',
        'billing_state',
        'billing_zip'
    ];

    public function getImageAttribute()
    {
        return $this->profile_image;
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cart() {
        return $this->hasOne('App\Cart');
    }

    public function adoption_form() {
        return $this->hasOne('App\AdoptionForm');
    }

    public function payments() {
        return $this->hasMany('App\Payment');
    }

    public function adoptForms()
    {
        return $this->hasMany('App\AdoptionForm', 'user_id');
    }

    public function fosterForms()
    {
        return $this->hasMany('App\FosterForm', 'user_id');
    }

    public function alerts()
    {
        return $this->hasMany('App\Alert', 'user_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Message', 'user_id');
    }

    public function sent()
    {
        return $this->hasMany('App\MessageThread', 'sender_id');
    }

    public function received()
    {
        return $this->hasMany('App\MessageThread', 'receiver_id');
    }
    public function posts()
    {
        return $this->hasMany('App\Post', 'user_id', 'id');
    }

    public function isAdmin() {
        return $this->admin;
    }
}
