<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\QueryException;

	/**
	 * Define the Context object of the GMI Project
	 *
	 * @property $id
	 * @property $context_to_string
	 */
	class Context extends Model {

		protected $table = 'contexts';

		protected $primaryKey = 'id';

		public $incrementing = true;

		protected $keyType = 'bigIncrements';

		public $timestamps = false;

		protected $attributes = [];

		protected $fillable = [
			'context_to_string',
		];

		protected $guarded = [
			'id',
		];


		/**
		 * Constructor of the Context Object.
		 * @param string $context the context for the object
		 */
		public function __constructor($context) {
			if($context == NULL || $context == '') {
				throw new QueryException('');
			}
			$this->contextToString = $context;
		}

		/**
		 * ToString of the context
		 */
		public function __toString() {
			return $this->id . ' - ' . $this->context_to_string;
		}
	}
