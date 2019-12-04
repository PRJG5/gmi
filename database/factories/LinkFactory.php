<?php

	/**
	 * @var Factory $factory
	 */

	use App\Card;
	use App\Link;
	use Faker\Generator as Faker;
	use Illuminate\Database\Eloquent\Factory;

	$factory->define(Link::class,
		function(Faker $faker) {
			$card_a = Card::all()->random();
			$card_b = Card::where('language_id',
				'!=',
				$card_a->language_id)->get()->random();
			return [
				'card_a' => $card_a->id,
				'card_b' => $card_b->id,
			];
		});
