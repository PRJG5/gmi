<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	/**
	 *
	 * @property $id
	 * @property $text_description
	 */
	class Phonetic extends Model {

		protected $table = 'phonetics';

		protected $primaryKey = 'id';

		public $incrementing = true;

		protected $keyType = 'bigIncrements';

		public $timestamps = false;

		protected $attributes = [
			'text_description' => '',
		];

		protected $fillable = [
			'text_description',
		];

		protected $guarded = [
			'id',
		];

		public function __toString() {
			return $this->id . ' - ' . $this->text_description;
		}
	}
