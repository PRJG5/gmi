<?php

	use Illuminate\Database\Seeder;

	class DatabaseSeeder extends Seeder {
		/**
		 * Seed the application's database.
		 *
		 * @return void
		 */
		public function run() {
			$this->call([
				LanguageTableSeeder::class,
				UserTableSeeder::class,
				SpokenLanguagesTableSeeder::class,
				DomainTableSeeder::class,
				SubdomainTableSeeder::class,
				CardTableSeeder::class,
				ContextTableSeeder::class,
				DefinitionTableSeeder::class,
				NoteTableSeeder::class,
				PhoneticTableSeeder::class,
				LinkTableSeeder::class,
				VoteTableSeeder::class,
			]);
		}
	}
