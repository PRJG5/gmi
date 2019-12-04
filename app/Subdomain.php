<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	/**
	 *
	 * @property $id
	 * @property $name
	 */
	class Subdomain extends Model {

		protected $table = 'subdomains';

		protected $primaryKey = 'id';

		public $incrementing = true;

		protected $keyType = 'bigIncrements';

		public $timestamps = false;

		protected $attributes = [
			'content' => '',
		];

		protected $fillable = [
			'content',
		];

		public function __toString() {
			return $this->id . ' - ' . $this->name;
		}
	}
