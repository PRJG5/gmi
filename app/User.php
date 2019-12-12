<?php

namespace App;
use App\SpokenLanguages;
use BenSampo\Enum\Enum;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

	protected $table = 'users';
	protected $primaryKey = 'id';
	public $incrementing = true;
	protected $keyType = 'bigIncrements';
	public $timestamps = true;

	protected $attributes = [
		'name' => '',
		'email' => '',
		'email_verified_at' => NULL,
		'password' => '',
		'remember_token' => NULL,
	];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name',
		'email',
		'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
		'password',
		'remember_token',
	];
	
	protected $guarded = [
        'id',
	];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * GET A LIST OF USER LANGUAGE OBJECT
     */
    public function getLanguages(){
        $languages = [];
        if($this->role == Enums\Roles::ADMIN){
            return Language::orderBy('content')->get();
        }else{

            return SpokenLanguages::join('languages', 'spoken_languages.languageISO', '=', 'languages.slug')->where('user_id',$this->id)->get();
        }

    }

    /**
     * GET A LIST OF USER LANGUAGE KEY ARRAY
     */
    public function getLanguagesKeyArray(){
        $languages = array();
        if($this->role == Enums\Roles::ADMIN){
            foreach(Language::get()->toarray() as $language){
                array_push($languages, $language['slug']);
            }
        }
        foreach(SpokenLanguages::select('languageISO')->where('user_id',$this->id)->get()->toarray() as $language){
            array_push($languages, $language['languageISO']);
        }

        return $languages;
    }
}
