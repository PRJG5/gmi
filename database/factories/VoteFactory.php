<?php

	/**
	 * @var Factory $factory
	 */

	use App\Card;
	use App\User;
	use App\Vote;
	use Faker\Generator as Faker;
	use Illuminate\Database\Eloquent\Factory;

	$factory->define(Vote::class,
		function(Faker $faker) {
			return [
				'user_id' => User::all()->random()->id,
				'card_id' => Card::all()->random()->id,
			];
		});
