<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'line_1',
        'line_2',
        'city',
        'state',
        'zip',
        'creditCardNumber',
        'creditCardMonth',
        'creditCardYear',
        'creditCardType',
        'creditCardCode',
        'note',
        'user_id',
        'plan',
        'status',
        'amount',
        'end_date',
        ];
}
