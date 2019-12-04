<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	/**
	 *
	 * @property $id
	 * @property $user_id
	 * @property $language_ISO
	 */
	class SpokenLanguages extends Model {

		private $id;
		private $user_id;
		private $language_ISO;

		protected $table = 'spoken_languages';

		protected $primaryKey = 'id';

		public $incrementing = true;

		protected $keyType = 'bigIncrements';

		public $timestamps = false;

		protected $attributes = [
			'user_id'     => NULL,
			'language_ISO' => '',
		];

		protected $fillable = [
			'user_id',
			'language_ISO',
		];

		protected $guarded = [
			'id',
		];

		public function __toString() {
			return $this->id . ' - ' . $this->user_id . ' - ' . $this->language_ISO;
		}
	}
