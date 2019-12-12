<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Vote;
use App\SpokenLanguages;
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
        'headingURL'    => NULL,
        'phonetic_id'	=> NULL,
        'domain_id'		=> '',
        'subdomain_id'	=> '',
        'definition_id'	=> NULL,
        'context_id'	=> NULL,
        'note_id'		=> NULL,
		'language_id'	=> '',
        'owner_id'		=> 1,
        'validation_id' => NULL,
        'validation_rate'=>70,
        'delete' => 0,
    ];

    /**
     * @var array The fields that can be mass edited.abs
     * @see https://laravel.com/docs/6.x/eloquent#mass-assignment
     */
    protected $fillable = [
        'heading',
        'headingURL',
        'phonetic_id',
        'domain_id',
        'subdomain_id',
        'definition_id',
        'context_id',
        'note_id',
        'language_id',
        'owner_id',
        'validation_id',
        'validation_rate',
        'delete',
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
			"\theadingURL:"		. $this->headingURL		. "\n" .
			"\tphonetic_id: "	. $this->phonetic_id	. "\n" .
			"\tdomain_id:"		. $this->domain_id		. "\n" .
			"\tdefinition_id: "	. $this->definition_id	. "\n" .
			"\tcontext_id: "	. $this->context_id		. "\n" .
			"\tnote_id: "		. $this->note_id		. "\n" .
			"\tlanguage_id: "	. $this->language_id	. "\n" .
            "\towner_id: "		. $this->owner_id		. "\n" .
            "\tvalidation_id "  . $this->validation_id  . "\n" .
		"}";
    }

    /**
     * auto relation beetwen foreign-key
     * Doc : https://laravel.com/docs/6.x/eloquent-relationships
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author  49923 : Quentin Gosset
     */
    public function domain()
    {
        return $this->belongsTo('App\Domain');
    }

    /**
     * auto relation beetwen foreign-key
     * Doc : https://laravel.com/docs/6.x/eloquent-relationships
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author  49923 : Quentin Gosset
     */
    public function subdomain()
    {
        return $this->belongsTo('App\Subdomain');
    }

    /**
     * auto relation beetwen foreign-key
     * Doc : https://laravel.com/docs/6.x/eloquent-relationships
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author  49923 : Quentin Gosset
     */
    public function context()
    {
        return $this->belongsTo('App\Context');
    }

    /**
     * auto relation beetwen foreign-key
     * Doc : https://laravel.com/docs/6.x/eloquent-relationships
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author  49923 : Quentin Gosset
     */
    public function definition()
    {
        return $this->belongsTo('App\Definition');
    }

    /**
     * auto relation beetwen foreign-key
     * Doc : https://laravel.com/docs/6.x/eloquent-relationships
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author  49923 : Quentin Gosset
     */
    public function note()
    {
        return $this->belongsTo('App\Note');
    }

    /**
     * auto relation beetwen foreign-key
     * Doc : https://laravel.com/docs/6.x/eloquent-relationships
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author  49923 : Quentin Gosset
     */
    public function phonetic()
    {
        return $this->belongsTo('App\Phonetic');
    }

    /**
     * auto relation beetwen foreign-key
     * Doc : https://laravel.com/docs/6.x/eloquent-relationships
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author  49923 : Quentin Gosset
     */
    public function validation()
    {
        return $this->belongsTo('App\Validation');
    }

    /**
     * auto relation beetwen foreign-key
     * Doc : https://laravel.com/docs/6.x/eloquent-relationships
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author  49923 : Quentin Gosset
     */
    public function owner()
    {
        return $this->belongsTo('App\User','owner_id');
    }

    
    /**
     * auto relation beetwen foreign-key
     * Doc : https://laravel.com/docs/6.x/eloquent-relationships
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->hasOne('App\Language', 'slug', 'language_id');
    }

    

    /**
     * This method is a computer attribute and count the number of vote
     * this methode can be direct called by $this->count_vote
     * https://laravel.com/docs/5.7/eloquent-mutators
     * @return int : number of vote
     * @author 49923 : Quentin Gosset
     */
    public function getCountVoteAttribute(): int {
        return Vote::where('card_id','=',$this->id)->count();
    }

    /**
     * This method return true if the card is valided
     * @return bool : status of the validation card
     * @author 49923 : Quentin Gosset
     */
    public function isValided(): bool{
        return isset($this->validation_id);
    }

    /**
     * This method return true if the card has been validate
     * @return bool : status if the card has been validate
     * @author 49923 : Quentin Gosset
     */
    public function validate(): bool{
        if(!$this->isValided()){
            /**
             * @YOURI mettre l'algo ici et mettre le resultat de ton algo dans $result
             */
            $userNb = SpokenLanguages::where('languageISO', '=', $this->language_id)->count();
            $voteNb = $this->getCountVoteAttribute();
            $resul = ($voteNb/$userNb)*100>=$this->validation_rate;
            if($resul){
                // create the validation object
                $validation = Validation::create([
                    'voteNb' => $voteNb,
                    'userNb' => $userNb,
                    'validationRate' => $this->validation_rate,
                    'validated_at' => date('Y-m-d')
                ]);
                $this->validation_id = $validation->id;
                $this->save();
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    /**
     * This method return true or false if the validation card has been removed
     * @return bool : status if the validation card has been removed
     * @author 49923 : Quentin Gosset
     */
    public function removeValidation(): bool{
        if($this->isValided()){
            // we remove the validation
            $this->validation->delete();
            $this->validation_id = null;
            $this->save();
            return true;
        }else{
            return false;
        }
    }

    public function getDefinition(){
        if($this->definition_id != null){
            $def = Definition::where('id','=',$this->definition_id)->get();
       return $def[0]->definition_content;
        }
        return "";
        
   }

   public function getDomain(){
    if($this->definition_id != null){
        $dom= Domain::where('id','=',$this->domain_id)->first();
        return $dom->content;
        }
        return "";
    }

    public function getSubDomain(){
        if($this->definition_id != null){
            $subdom= Subdomain::where('id','=',$this->subdomain_id)->first();
            return $subdom->content;
        }
            return "";
    }

    public function getLanguage(){
        $langs = Language::where('slug','=',$this->language_id)->get();
        if(count($langs)>0)
            return $langs[0]->content;
        else{
            return null;
        }
    }

    public function getNote(){
        if($this->note_id !=null){
            $note = Note::where('id',$this->note_id)->get();
        return $note[0]->description;
        }
        return "";
    }

    public function getContext(){
        if($this->context_id !=null){
            $cont = Context::where('id',$this->context_id)->first();
            return $cont->context_to_string;
        }
        return "";
    }

    public function getPhonetic(){
        if($this->phonetic_id != null){
            $pho = Phonetic::where('id',$this->phonetic_id)->first();
            return $pho->textDescription;
        }
        return "";
    }

    public function getHeading(){
        return $this->heading;
    }

	/*
	 * Returns all links referring to this card in an array.
	 * @author 49222
	 */
    public function links() {
        //TODO: Trouver le fonctionnement du hasManyThrough ----> return $this->hasManyThrough('\App\Card','App\Link');
        return DB::table('links')->select('*')->where(['cardA', '=', $this->id])->orWhere(['cardB', '=', $this->id])->get();
    }

    public function getLinkedCard(){
        $cardAid = collect();
        $cardBid = collect();
        $cardBtemp =Link::select('cardB')->where('cardA','=',$this->id)->get();
        $cardAtemp =Link::select('cardA')->where('CardB','=',$this->id)->get();

        foreach($cardBtemp as $idB){
            $cardBid->push($idB->cardB);
        }

        foreach($cardAtemp as $idA){
            $cardAid->push($idA->cardA);
        }

         return Card::whereIn('id',$cardAid)->orwhereIn('id',$cardBid)->get();
    }

    public function  getCardFilterByLanguage(){
        $user= Auth::user();
        $varTemp = collect();
        $collectCard = collect();
        $cardsLinked = collect();

        foreach($user->getLanguagesKeyArray() as $lang){
            $temp = Card::where('language_id',$lang)->get();
            if(!$temp->first()==null){
                //Faire une collection de collection 
                $varTemp->prepend(Card::where('language_id',$lang)->where('delete','=','0')->get());
            }
        }

        //Ici on va tout mettre dans une collection 
        foreach($varTemp as $collection){
            foreach($collection as $collectionitem){
                $collectCard->push($collectionitem->id);
            }
        }

        $cardsLinked = Card::getLinkedCard();
        //1. On prend toutes les cartes qui sont de la langues de l'utilisateur.
        //2. On prend pas toutes les cartes liés a la carte courantes 
        //3. On prend pas la carte courante 
        //4. On prend pas les cartes de la langues de la carte courante 

        return Card::whereIn('id',$collectCard)->whereNotIn('id',$cardsLinked->pluck('id'))->where('id','!=',$this->id)->where('language_id','!=',$this->language_id)->get();
    }

    

//         SELECT * 
// FROM `cards` 
// WHERE language_id != "BUL" 
// AND id != 1 
// AND id NOT IN ( SELECT cardB 
//                	FROM links 
//                 WHERE cardA = 1)
                
// AND id NOT IN (SELECT cardA
//                FROM links
//                WHERE cardB=1);
               
    

    public function versions(){

        return $this->belongsToMany('App\Card' ,'card_card' , 'cardOrigin' , 'cardVersion');
    }
}
