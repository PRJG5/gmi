<?php

	use App\User;
	use Illuminate\Database\Seeder;

	/**
	 * Seeder file for the Card table.
	 * @author 44422
	 */
	class UserTableSeeder extends Seeder {

		/**
		 * Creates 50 fake cards into the database.
		 * @author 44422
		 */
		public function run() {
			factory(User::class,
				50)->create();
		}
	}
