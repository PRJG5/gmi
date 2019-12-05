<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @author 49762
 */
class Media extends Model
{
	protected $table = 'medias';
	protected $primaryKey = 'id';
    protected $keyType = 'bigIncrements';
	
    protected $attributes = [
		'imageUrl' => '',
		'soundUrl' => '',
		'linkUrl' => ''
	];
    
	protected $fillable = [
		'imageUrl' => '',
		'soundUrl' => '',
		'linkUrl' => ''
	];
    
	protected $guarded = [
        'id',
	];
    
    public $incrementing = true;
	public $timestamps = false;
}
