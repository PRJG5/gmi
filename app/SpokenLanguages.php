<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpokenLanguages extends Model
{

	protected $table = 'spoken_languages';
	protected $primaryKey = 'id';
	public $incrementing = true;
	protected $keyType = 'bigIncrements';
	public $timestamps = false;
	protected $attributes = [
		'user_id' => NULL,
		'languageISO' => '',
	];
    protected $fillable = [
		'user_id',
		'languageISO',
	];
	protected $guarded = [
        'id',
	];
}
