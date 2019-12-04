<?php

	namespace App;

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

		private $id;
		private $name;
		private $email;
		private $email_verified_at;
		private $password;
		private $remember_token;
		private $role;

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
			if($this->role == Enums\Roles::ADMIN) {
				foreach(Language::get()->toarray() as $language) {
					$languages[] = (object) [
						'key'         => $language['slug'],
						'description' => $language['content'],
					];
				}
			}
			foreach(SpokenLanguages::select('language_ISO')->where('user_id', $this->id)->get()->toarray() as $language) {
				$languages[] = (object) [
					'key'         => $language['language_ISO'],
					'description' => Language::where('slug', $language['language_ISO'])->first()->content,
				];
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
					array_push($languages, $language['slug']);
				}
			}
			foreach(SpokenLanguages::select('language_ISO')->where('user_id', $this->id)->get()->toarray() as $language) {
				array_push($languages, $language['language_ISO']);
			}

			return $languages;
		}
	}
