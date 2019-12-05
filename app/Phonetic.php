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
	];
	protected $guarded = [
        'id',
	];
    
    public function medias() {
        return $this->belongsToMany('App\Media' ,'phonetic_media' , 'phonetic' , 'media');
    }
}
