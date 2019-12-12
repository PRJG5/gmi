<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Represents a vote 
 */
class Vote extends Model
{
    
    protected $table = 'votes';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'bigIncrements';
    public $timestamps = false;
    
    protected $attributes = [
        'user_id' => '',
        'card_id' => '',
    ];
    
    protected $fillable = [
		'user_id',
        'card_id',
	];
    
	protected $guarded = [
        'id',
	];

	static function hasVote($userId,$cardId){
	    return Vote::where('user_id','=',$userId)->where('card_id','=',$cardId)->count();
	}

}

?>
