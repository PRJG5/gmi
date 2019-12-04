<?php

	use Illuminate\Database\Seeder;

	class ContextTableSeeder extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run() {
			factory(App\Context::class,
				50)->create();
		}
	}
