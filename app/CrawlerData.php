<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrawlerData extends Model
{
    protected $fillable = [
        'value',
        'category'
    ];
}
