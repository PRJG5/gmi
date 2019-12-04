<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	/**
	 * Represents a vote
	 */
	class Vote extends Model {

		private $id;
		private $user_id;
		private $card_id;

		protected $table = 'votes';

		protected $primaryKey = 'id';

		public $incrementing = true;

		protected $keyType = 'bigIncrements';

		public $timestamps = false;

		protected $attributes = [
			'user_id' => '',
			'card_id' => '',
		];

		protected $fillable = [
			'user_id',
			'card_id',
		];

		protected $guarded = [
			'id',
		];

		public function __toString() {
			return $this->id . ' - ' . $this->user_id . ' - ' . $this->card_id;
		}

	}

