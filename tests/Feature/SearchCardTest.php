<?php

	namespace Tests\Feature;

	use App\Card;
	use App\User;
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Tests\TestCase;

	class SearchCardTest extends TestCase {
		use RefreshDatabase;

		/**
		 * A basic feature test example.
		 *
		 * @return void
		 */
		public function test1() {
			$card1 = new Card([
				'heading'     => 'Persona',
				'language_id' => 'ENG',
			]);
			$card1->save();

			$card2 = new Card([
				'heading'     => 'Shadow',
				'language_id' => 'FRA',
			]);
			$card2->save();

			$card3 = new Card([
				'heading'     => 'Hello',
				'language_id' => 'HUY',
			]);
			$card3->save();

			$card4 = new Card([
				'heading'     => 'Heyololo',
				'language_id' => 'FRA',
			]);
			$card4->save();

			$card5 = new Card([
				'heading'     => 'Pouloulou',
				'language_id' => 'ENG',
			]);
			$card5->save();

			$user = new User([
				'name'     => 'lolo',
				'email'    => 'loic.corbion@gmail.com',
				'password' => 'lolofire',
			]);
			$user->save();

			$this->actingAs($user);
			$response = $this->get('/cards');
			$response->assertSeeText('Shadow');
			$response->assertSeeText('Persona');
			$response->assertSeeText('Heyololo');
			$response->assertSeeText('Pouloulou');
			$this->get('/allCards?search=Shadow&languages=All');
			$response->assertSeeText('Shadow');
			$response->assertSeeText('FRA');

			//testAllLanguageAllHeading();

			$response = $this->get('/cards');
			$response->assertSeeText('Shadow');
			$response->assertSeeText('Persona');
			$response->assertSeeText('Heyololo');
			$response->assertSeeText('Pouloulou');

			//testDontSeeLanguage();

			$response = $this->get('/cards');
			$response->assertSeeText('Shadow');
			$response->assertSeeText('Heyololo');
			$response->assertDontSeeText('Pouloulou');
			$response->assertDontSeeText('Persona');

			$response->assertStatus(200);
		}


	}
