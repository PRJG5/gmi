<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Represents a Card (usually referred as "Fiche")
 * Each Card only has one and only one "idea",
 * meaning that two words with the same "Vedette" (spelling) will be represented by two different cards.
 *
 * @author 44422
 */
class Card extends Model
{
    /**
     * @var string SQL table name for cards.
     * This is the name of the SQL table containing all the cards and their infos.
     * By default, Eloquent will assume the infos of the class are stored
     * in the table having the same name as the class except in plural form.
     * e.g. infos of "Card" class will be stored in the "cards" table.
     * @see https://laravel.com/docs/6.x/eloquent#defining-models section "Table names"
    */
    protected $table = 'cards';


    /**
     * @var string SQL primary key name for table cards.
     * This is the name of the SQL primary key of the table containing all the cards and their infos.
     * By default, Eloquent will assume the primary key of the table is named "id".
     * This variable is overriding the default primary key name.
     * @see https://laravel.com/docs/6.x/eloquent#defining-models section "Primary keys"
    */
    protected $primaryKey = 'id';


    /**
     * @var bool If the primary key "id" is auto-incrementing or not.
     * This variable can be set to "false" disable the auto-increment inside the SQL table for the primary key.
     * By default, this variable is set to "true".
     * @see https://laravel.com/docs/6.x/eloquent#defining-models section "Primary keys"
     */
    public $incrementing = true;


    /**
     * @var string The type of the table primary key.
     * Overrides the default type of the primary key.
     * Default type is set to "integer".
     * @see https://laravel.com/docs/6.x/eloquent#defining-models section "Primary keys"
     * @see https://laravel.com/docs/6.x/migrations#creating-columns
     */
    protected $keyType = 'bigIncrements';


    /**
     * @var boolean If set to false, disable creation of timestamp columns in the table.
     * Default value is true, and Eloquent will create a "created_at" and "updated_at" column,
     * which is not really needed in this case.
     * @see https://laravel.com/docs/6.x/eloquent#defining-models section "Timestamps"
     */
    public $timestamps = false;


    /**
     * @var string The format of the "created_at" and "updated_at" timestamps in the database.
     * Since the timestamps are disabled (see above), we don't need such variable.
     * @see https://laravel.com/docs/6.x/eloquent#defining-models section "Timestamps"
     */
    // protected $dateFormat = 'U';


    /**
     *
     * @var string The name for the connection to use when connecting to the database.
     * If set, this will override the database connection set in the .env file.
     * Thus, we don't need this.
     * @see https://laravel.com/docs/6.x/eloquent#defining-models section "Database Connection"
     */
    // protected $connection = 'connection-name';

    /**
     * @var array The default values for the different attributes.
     * The model's default values for attributes.
     * @see https://laravel.com/docs/6.x/eloquent#default-attribute-values
     */
    protected $attributes = [
        'heading'		=> '',
        'phonetic_id'	=> NULL,
        'domain_id'		=> '',
        'subdomain_id'	=> '',
        'definition_id'	=> NULL,
        'context_id'	=> NULL,
        'note_id'		=> NULL,
		'language_id'	=> '',
        'owner_id'		=> 1,
        'nbVotes'       => 0,
    ];

    /**
     * @var array The fields that can be mass edited.abs
     * @see https://laravel.com/docs/6.x/eloquent#mass-assignment
     */
    protected $fillable = [
        'heading',
        'phonetic_id',
        'domain_id',
        'subdomain_id',
        'definition_id',
        'context_id',
        'note_id',
        'language_id',
        'owner_id',
        'nbVotes',
        'validation_id',
    ];

    /**
     * @var array The fields that cannot be mass edited.
     * @see https://laravel.com/docs/5.8/eloquent#mass-assignment
     */
    protected $guarded = [
        'id',
	];
	
	/**
	 * Returns a string describing the card
	 * @return string a string describing the card
	 */
	public function __toString() {
		return
		"{ Card\n" .
			"\tid: "			. $this->id				. "\n" .
			"\theading:"		. $this->heading		. "\n" .
			"\tphonetic_id: "	. $this->phonetic_id	. "\n" .
			"\tdomain_id:"		. $this->domain_id		. "\n" .
			"\tdefinition_id: "	. $this->definition_id	. "\n" .
			"\tcontext_id: "	. $this->context_id		. "\n" .
			"\tnote_id: "		. $this->note_id		. "\n" .
			"\tlanguage_id: "	. $this->language_id	. "\n" .
            "\towner_id: "		. $this->owner_id		. "\n" .
            "\tnbVotes: "       . $this->nbVotes        . "\n" .
            "\tvalidation_id "  . $this->validation_id  . "\n" .
		"}";
    }


	/*
	 * Returns all links referring to this card in an array.
	 * @author 49222
	 */
    public function links() {
        //TODO: Trouver le fonctionnement du hasManyThrough ----> return $this->hasManyThrough('\App\Card','App\Link');
        return DB::table('links')->select('*')->where(['cardA', '=', $this->id])->orWhere(['cardB', '=', $this->id])->get();
    }

    public function versions(){

        return $this->belongsToMany('App\Card' ,'card_card' , 'cardOrigin' , 'cardVersion');
    }
}
