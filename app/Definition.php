<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Represents a Definition of a card.
 */
class Definition extends Model
{

    /**
     * @var string SQL table name for definitions.
     * This is the name of the SQL table containing all the definitions and their infos.
     * By default, Eloquent will assume the infos of the class are stored
     * in the table having the same name as the class except in plural form.
     * e.g. infos of "Definition" class will be stored in the "definitions" table.
     * @see https://laravel.com/docs/6.x/eloquent#defining-models section "Table names"
    */
    protected $table = 'definitions';


    /**
     * @var string SQL primary key name for table definitions.
     * This is the name of the SQL primary key of the table containing all the definitions and their infos.
     * By default, Eloquent will assume the primary key of the table is named "id".
     * This variable is overriding the default primary key name.
     * @see https://laravel.com/docs/6.x/eloquent#defining-models section "Primary keys"
    */
	protected $primaryKey = 'id';
	
	public $incrementing = true;

	protected $keyType = 'bigIncrements';

    public $timestamps = false;

	protected $attributes = [
		'definition_content' => '',
	];

    protected $fillable = [
        'definition_content',
	];
	
	protected $guarded = [
        'id',
	];

    /**
     * Returns a string of the definition with his id and content
     * @return string
     * @author 49102
     */
    public function __toString() {
        return $this->id . " - " . $this->definition_content;
     }
}
