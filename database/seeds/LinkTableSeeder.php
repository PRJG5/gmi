<?php

	use App\Link;
	use Illuminate\Database\Seeder;

	/**
	 * Seeder file for the Card table.
	 * @author 44422
	 */
	class LinkTableSeeder extends Seeder {

		/**
		 * Creates 50 fake cards into the database.
		 * @author 44422
		 */
		public function run() {
			factory(Link::class,
				50)->create();
		}
	}
