<?php

	use App\SpokenLanguages;
	use Illuminate\Database\Seeder;

	/**
	 * Seeder file for the Card table.
	 * @author 44422
	 */
	class SpokenLanguagesTableSeeder extends Seeder {

		/**
		 * Creates 50 fake cards into the database.
		 * @author 44422
		 */
		public function run() {
			factory(SpokenLanguages::class,
				50)->create();
		}
	}
