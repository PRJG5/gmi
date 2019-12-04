<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	/**
	 *
	 * @property $id
	 * @property $content
	 * @property $slug
	 */
	class Language extends Model {

		protected $table = 'languages';

		protected $primaryKey = 'id';

		public $incrementing = true;

		protected $keyType = 'bigIncrements';

		public $timestamps = false;

		protected $attributes = [
			'content' => '',
			'slug'    => '',
		];

		protected $fillable = [
			'content',
			'slug',
		];

		protected $guarded = [
			'id',
		];

		public function __toString() {
			return $this->id . ' - ' . $this->content . ' - ' . $this->slug;
		}

	}
