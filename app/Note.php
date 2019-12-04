<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	/**
	 * Model from Eloquent representing a Note who belongs to a Card model object.
	 *
	 * @property $id
	 * @property $description
	 */
	class Note extends Model {

		private $id;
		private $description;

		protected $table = 'notes';

		protected $primaryKey = 'id';

		public $incrementing = true;

		protected $keyType = 'bigIncrements';

		public $timestamps = false;

		protected $attributes = [
			'description' => '',
		];

		protected $fillable = [
			'description',
		];

		protected $guarded = [
			'id',
		];

		public function card() {
			return $this->belongsTo(Card::class);
		}

		public function __toString() {
			return $this->id . ' - ' . $this->description;
		}
	}
