<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Define the Context object of the GMI Project
 */
class Context extends Model
{
	protected $table = 'contexts';
	protected $primaryKey = 'id';
	public $incrementing = true;
	protected $keyType = 'bigIncrements';
	public $timestamps = false;
	protected $fillable = [
		'context_to_string',
        'image',
        'url',
        'son',
	];
	protected $guarded = [
        'id',
	];
    

    /**
     * Constructor of the Context Object.
     */
 	// public function __constructor($context){
    // 		$this->contextToString = $context;
    // }

    // public function getNameOfContext(){
    // 		return $this->contextToString;
    // }

    /**
     * ToString of the context
     */
    public function __toString(){
         return $this->id ." ".  $this->context_to_string;
    }
}
