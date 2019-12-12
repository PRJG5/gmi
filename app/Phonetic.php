<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phonetic extends Model
{
	protected $table = 'phonetics';
	protected $primaryKey = 'id';
	public $incrementing = true;
	protected $keyType = 'bigIncrements';
	public $timestamps = false;
	protected $attributes = [
		'textDescription' => '',
	];
	protected $fillable = [
		'textDescription',
        'image',
        'url',
        'son',
	];
	protected $guarded = [
        'id',
	];
}
