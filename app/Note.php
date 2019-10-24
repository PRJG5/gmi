<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model from Eloquent representing a Note who belongs to a Card model object.
 */
class Note extends Model
{

    protected $fillable = ['description'];

    public function card(){
        return $this->$belongsTo(Card::class);
    }

    public function __toString()
    {
        return $this->id . " - " .  $this->description;
    }
}
