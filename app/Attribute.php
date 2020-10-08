<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'pet_id',
        'friendly',
        'calm',
        'energetic',
        'good_with_kids',
        'drools',
        'vocal',
        'trained',
        'novice_owner_ok',
        'escape_artist',
        'special_needs',
        'aggressive_toward_humans',
        'aggressive_toward_dogs',
        'aggressive_toward_cats',
        'aggressive_toward_kids',
        'shed_level'
    ];

    public function pet() {
        return $this->belongsTo('App\Pet'); // change to traits, makes more sense
    }
}
