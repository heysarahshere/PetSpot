<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Pet extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'image1_url',
        'image2_url',
        'image3_url',
        'species',
        'breed',
        'gender',
        'size',
        'status',
        'age',
        'weight',
        'fur_level'
    ];

    public function traits() {
        return $this->hasOne('App\Attribute'); // change to traits, makes more sense
    }

//    public function orders() {
//        return $this->hasMany('App\Order')->orderBy('created_at');
//    }
}
