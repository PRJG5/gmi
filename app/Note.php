<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function card(){
        return $this->$belongsTo(Card::class);
    }

    public function __toString()
    {
        return $this->id . $this->description;
    }
}
