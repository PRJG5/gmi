<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['cardA','cardB'];
    public $timestamps = false;

    public function cardsA()
    {
        return $this->belongsTo('App\Card','cardsA');
    }
    
    public function cardsB()
    {
        return $this->belongsTo('App\Card','cardsB');
    }
    



}
