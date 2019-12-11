<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'content',
        'slug',
        'isSigned'
    ];

    public $timestamps = false;

}