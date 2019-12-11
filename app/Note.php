<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model from Eloquent representing a Note who belongs to a Card model object.
 */
class Note extends Model
{
	protected $table = 'notes';
	protected $primaryKey = 'id';
	public $incrementing = true;
	protected $keyType = 'bigIncrements';
	public $timestamps = false;
	protected $attributes = [
		'description' => '',
	];
    protected $fillable = [
		'description',
        'image',
        'url',
        'son',
	];
	protected $guarded = [
        'id',
	];

    public function card(){
        return $this->belongsTo(Card::class);
    }

    public function __toString()
    {
        return strval($this->id) . " - " .  $this->description;
    }
}
