<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


// Relation between two cards
class Link extends Model
{
	protected $table = 'links';
	protected $primaryKey = 'id';
	public $incrementing = true;
	protected $keyType = 'bigIncrements';
	public $timestamps = false;
	protected $attributes = [
		'cardA' => NULL,
		'cardB' => NULL,
	];
    protected $fillable = [
		'cardA',
		'cardB',
	];
	protected $guarded = [
        'id',
	];

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
