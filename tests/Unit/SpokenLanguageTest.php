<?php

	namespace Tests\Unit;

	use App\SpokenLanguages;
	use App\User;
	use Illuminate\Database\QueryException;
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Illuminate\Support\Facades\DB;
	use Tests\TestCase;

	class SpokenLanguageTest extends TestCase {

		use RefreshDatabase;

		/** @test */
		public function add_user_one_lang_ok() {
			$user = new User();
			$user->name = 'user';
			$user->email = 'user@example.com';
			$user->password = 'userPassword';
			$user->save();

			$userDB = DB::table('users')->where('email',
				$user->email)->first();

			$spokenLanguage = new SpokenLanguages();
			$spokenLanguage->user_id = $userDB->id;
			$spokenLanguage->language_ISO = 'SPA';
			$spokenLanguage->save();

			$this->assertDatabaseHas('spoken_languages', [
					'user_id'      => $spokenLanguage->user_id,
					'language_ISO' => $spokenLanguage->language_ISO,
				]);
		}

		/** @test */
		public function add_user_with_two_lang_ok() {

			$user = new User();
			$user->name = 'user';
			$user->email = 'user@example.com';
			$user->password = 'userPassword';
			$user->save();

			$userDB = DB::table('users')->where('email',
				$user->email)->first();

			$spokenLanguage = new SpokenLanguages();
			$spokenLanguage->user_id = $userDB->id;
			$spokenLanguage->language_ISO = 'SPA';
			$spokenLanguage->save();
			$spokenLanguage2 = new SpokenLanguages();
			$spokenLanguage2->user_id = $userDB->id;
			$spokenLanguage2->language_ISO = 'FRA';
			$spokenLanguage2->save();

			$this->assertDatabaseHas('spoken_languages', [
					'user_id'      => $spokenLanguage->user_id,
					'language_ISO' => $spokenLanguage->language_ISO,
				]);
			$this->assertDatabaseHas('spoken_languages', [
					'user_id'      => $spokenLanguage2->user_id,
					'language_ISO' => $spokenLanguage2->language_ISO,
				]);
		}

		/** @test */
		public function add_two_users_with_same_lang() {
			$user = new User();
			$user->name = 'user';
			$user->email = 'user@example.com';
			$user->password = 'userPassword';
			$user->save();

			$user2 = new User();
			$user2->name = 'nico';
			$user2->email = 'user2@example.com';
			$user2->password = 'userPassword';
			$user2->save();

			$userDB = DB::table('users')->where('email',
				$user->email)->first();
			$userDB2 = DB::table('users')->where('email',
				$user2->email)->first();

			$spokenLanguage = new SpokenLanguages();
			$spokenLanguage->user_id = $userDB->id;
			$spokenLanguage->language_ISO = 'SPA';
			$spokenLanguage->save();
			$spokenLanguage = new SpokenLanguages();
			$spokenLanguage->user_id = $userDB2->id;
			$spokenLanguage->language_ISO = 'SPA';
			$spokenLanguage->save();

			$this->assertDatabaseHas('spoken_languages', [
					'user_id'      => $userDB->id,
					'language_ISO' => $spokenLanguage->language_ISO,
				]);

			$this->assertDatabaseHas('spoken_languages', [
					'user_id'      => $userDB2->id,
					'language_ISO' => $spokenLanguage->language_ISO,
				]);

		}

		/** @test */
		public function add_user_with_two_same_lang() {
			$user = new User();
			$user->name = 'user';
			$user->email = 'user@example.com';
			$user->password = 'userPassword';
			$user->save();

			$userDB = DB::table('users')->where('email',
				$user->email)->first();

			$this->expectException(QueryException::class);
			$spokenLanguage = new SpokenLanguages();
			$spokenLanguage->user_id = $userDB->id;
			$spokenLanguage->language_ISO = 'SPA';
			$spokenLanguage->save();
			$spokenLanguage = new SpokenLanguages();
			$spokenLanguage->user_id = $userDB->id;
			$spokenLanguage->language_ISO = 'SPA';
			$spokenLanguage->save();
		}
	}
