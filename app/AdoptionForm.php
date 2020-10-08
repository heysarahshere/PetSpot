<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdoptionForm extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address_line_1',
        'address_line_2',
        'city',
        'zip',
        'state',
        'answer_1',
        'answer_2',
        'answer_3',
        'urgency',
        'pet_name',
        'pet_id',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
