<?php

	namespace App;

	use Exception;
	use Illuminate\Foundation\Auth\User as Authenticatable;

	/**
	 *
	 * @property $id
	 * @property $name
	 * @property $email
	 * @property $email_verified_at
	 * @property $password
	 * @property $remember_token
	 * @property $role
	 */
	class User extends Authenticatable {

		protected $table = 'users';

		protected $primaryKey = 'id';

		public $incrementing = true;

		protected $keyType = 'bigIncrements';

		public $timestamps = true;

		protected $attributes = [
			'name'              => '',
			'email'             => '',
			'email_verified_at' => NULL,
			'password'          => '',
			'remember_token'    => NULL,
			'role'              => 2,
			'api_token'         => NULL,
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
			'remember_token',
			'role',
			'api_token',
		];

		/**
		 * The attributes that should be hidden for arrays.
		 *
		 * @var array
		 */
		protected $hidden = [
			'password',
			'remember_token',
			'api_token',
		];

		protected $guarded = [
			'id',
		];

		/**
		 * The attributes that should be cast to native types.
		 * @var array
		 */
		protected $casts = [
			'email_verified_at' => 'datetime',
		];

		/**
		 * Get a list of user language object
		 */
		public function getLanguages() {
			$languages = [];
			if($this->role == 0) {
				foreach(Language::get()->toarray() as $language) {
					array_push($languages,
						(object) [
							'key'         => $language['slug'],
							'description' => $language['content'],
						]);
				}
			} else {
				foreach(SpokenLanguages::where('user_id',
					$this->id)->get()->toarray() as $language) {
					$language = (object) $language;
					array_push($languages,
						(object) [
							'key'         => $language->language_ISO,
							'description' => Language::where('slug',
								$language->language_ISO)->first()['content'],
						]);
				}
			}
			return $languages;
		}

		/**
		 * Get a list of user language key array
		 */
		public function getLanguagesKeyArray() {
			$languages = [];
			if($this->role == Enums\Roles::ADMIN) {
				foreach(Language::get()->toarray() as $language) {
					array_push($languages,
						$language['slug']);
				}
			}
			foreach(SpokenLanguages::select('language_ISO')->where('user_id',
				$this->id)->get()->toarray() as $language) {
				array_push($languages,
					$language['language_ISO']);
			}

			return $languages;
		}

		/**
		 * Gets a new API token for the user and stores the token in the database
		 * @param int length the length of the token
		 * @return string
		 * @throws Exception
		 */
		public function getAPIToken($length = 32) {
			$token = bin2hex(random_bytes($length));
			$this->api_token = hash('sha256',
				$token);
			$this->save();
			return $token;
		}

		/**
		 * Checks if the provided token is a valid API token
		 * @param $token
		 * @return bool
		 */
		public function checkAPIToken($token) {
			return $this->api_token == hash('sha256',
					$token);
		}

		/**
		 * Returns true if the user speaks the languages provided as parameter
		 * @param $languages_id
		 * @return boolean true if the user speaks this language
		 */
		public function speaks($languages_id) {
			return count(SpokenLanguages::where('user_id',
					$this->id)->where('language_ISO',
					$languages_id)->get()) == 1;
		}
	}
