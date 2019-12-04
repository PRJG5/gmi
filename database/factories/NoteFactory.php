<?php

	/**
	 * @var Factory $factory
	 */

	use App\Note;
	use Faker\Generator as Faker;
	use Illuminate\Database\Eloquent\Factory;

	$factory->define(Note::class,
		function(Faker $faker) {
			return [
				'description' => $faker->sentence(),
			];
		});
