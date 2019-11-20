<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Card;


// Relation between two cards
class Link extends Model
{
    
    protected $fillable = ['cardA','cardB'];
    public $timestamps = false;

    //Get one card
    public function getCardA()
    {
        // return $this->belongsTo('App\Card','cardsA'); TODO: Trouver le fonctionnement du hasManyThrough (voir le todo de Card)
        return Card::find($this->cardA);
    }
    //Get the other
    public function getCardB()
    {
        // return $this->belongsTo('App\Card','cardsB'); TODO: Trouver le fonctionnement du hasManyThrough (voir le todo de Card
        return Card::find($this->cardB);
    }
}
