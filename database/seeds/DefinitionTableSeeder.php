<?php

	use App\Definition;
	use Illuminate\Database\Seeder;

	/**
	 * Seeder file for the Card table.
	 * @author 44422
	 */
	class DefinitionTableSeeder extends Seeder {

		/**
		 * Creates 50 fake cards into the database.
		 * @author 44422
		 */
		public function run() {
			factory(Definition::class,
				50)->create();
		}
	}
