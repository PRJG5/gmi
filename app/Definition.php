<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Definition extends Model
{
    protected $primaryKey = 'definition_id';

    protected $fillable = [
        'definition_content',
        'card',
    ];
}
