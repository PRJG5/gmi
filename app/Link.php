<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	/**
	 * Relation between two cards
	 *
	 * @property $id
	 * @property $card_a
	 * @property $card_b
	 */
	class Link extends Model {

		private $id;
		private $card_a;
		private $card_b;

		protected $table = 'links';

		protected $primaryKey = 'id';

		public $incrementing = true;

		protected $keyType = 'bigIncrements';

		public $timestamps = false;

		protected $attributes = [
			'card_a' => NULL,
			'card_b' => NULL,
		];

		protected $fillable = [
			'card_a',
			'card_b',
		];

		protected $guarded = [
			'id',
		];

		/**
		 * Get one card
		 * @return Card
		 */
		public function getCardA() {
			// return $this->belongsTo('App\Card', 'cardsA'); TODO: Trouver le fonctionnement du hasManyThrough (voir le todo de Card)
			return Card::find($this->card_a);
		}

		/**
		 * Get the other
		 * @return Card
		 */
		public function getCardB() {
			// return $this->belongsTo('App\Card', 'cardsB'); TODO: Trouver le fonctionnement du hasManyThrough (voir le todo de Card
			return Card::find($this->card_b);
		}

		public function __toString() {
			return $this->id . ' - ' . $this->card_a . ' - ' . $this->card_b;
		}
	}
