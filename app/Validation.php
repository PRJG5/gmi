<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    protected $fillable = [
        'voteNb',
        'userNb',
        'validationRate',
        'validated_at'
	];

    public function __toString(){
        return $this->id
        . " [votes:" . $this->voteNb
        . ", users:" . $this->userNb
        . ", validation rate:" . $this->validationRate
        . "%, validated at:" . $this->validated_at
        . "]"; 
   }
}
