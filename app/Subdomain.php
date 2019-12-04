<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	/**
	 *
	 * @property $id
	 * @property $name
	 */
	class Subdomain extends Model {

		private $id;
		private $name;

		protected $table = 'subdomains';

		protected $primaryKey = 'id';

		public $incrementing = true;

		protected $keyType = 'bigIncrements';

		public $timestamps = false;

		protected $attributes = [
			'name' => '',
		];

		protected $fillable = [
			'name',
		];

		public function __toString() {
			return $this->id . ' - ' . $this->name;
		}
	}
