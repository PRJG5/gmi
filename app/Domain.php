<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	/**
	 *
	 * @property $id
	 * @property $content
	 */
	class Domain extends Model {

		protected $table = 'domains';

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

		protected $guarded = [
			'id',
		];

		public function __toString() {
			return $this->id . ' - ' . $this->content;
		}

	}
