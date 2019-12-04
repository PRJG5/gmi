<?php

	namespace Tests\Unit;

	use App\Card;
	use App\Link;
	use App\User;
	use Illuminate\Database\QueryException;
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Tests\TestCase;

	class LinkTest extends TestCase {

		use RefreshDatabase;

		/**
		 * @test
		 * Test a link with two cards ok
		 */
		public function linkOkTest() {
			$user = new User([
				'name'     => 'Tester',
				'email'    => 'tester@test.com',
				'password' => 'tested',
			]);
			$user->save();

			$card_a = new Card([
				'heading'    => 'test1',
				'definition' => 'blabla2',
				'owner_id'   => $user->id,
			]);
			$card_a->save();

			$card_b = new Card([
				'heading'    => 'test2',
				'definition' => 'blabla2',
				'owner_id'   => $user->id,
			]);
			$card_b->save();

			$link = new Link([
				'card_a' => $card_a->id,
				'card_b' => $card_b->id,
			]);
			$link->save();

			$this->assertDatabaseHas('links', [
					'id'     => $link->id,
					'card_a' => $link->card_a,
					'card_b' => $link->card_b,
				]);
		}

		/**
		 * @test
		 * Test with a link, where the first card is same of the second. Is error.
		 */
		public function linkWithSameCardTest() {
			$user = new User([
				'name'     => 'Tester',
				'email'    => 'tester@test.com',
				'password' => 'tested',
			]);
			$user->save();

			$card_a = new Card([
				'heading'    => 'test1',
				'definition' => 'blabla2',
				'owner_id'   => $user->id,
			]);
			$card_a->save();

			$link = new Link();
			$this->expectException(QueryException::class);
			$link->card_a = $card_a->id;
			$link->card_b = $card_a->id;
			$link->save();
		}


		/**
		 * @test
		 * Test with two links, with the same cards
		 */
		public function twoSameLinksNotOKTest() {
			$user = new User([
				'name'     => 'Tester',
				'email'    => 'tester@test.com',
				'password' => 'tested',
			]);
			$user->save();

			$card_a = new Card([
				'heading'    => 'test1',
				'definition' => 'blabla2',
				'owner_id'   => $user->id,
			]);
			$card_a->save();

			$card_b = new Card([
				'heading'    => 'test1',
				'definition' => 'blabla2',
				'owner_id'   => $user->id,
			]);
			$card_b->save();

			$link = new Link();
			$link->card_a = $card_a->id;
			$link->card_b = $card_a->id;
			$this->expectException(QueryException::class);
			$link->save();

			$link = new Link();
			$link->card_a = $card_a->id;
			$link->card_b = $card_a->id;
			$link->save();
		}


	}
