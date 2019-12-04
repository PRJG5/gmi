<?php

	/**
	 * @var Factory $factory
	 */

	use App\Phonetic;
	use Faker\Generator as Faker;
	use Illuminate\Database\Eloquent\Factory;

	$factory->define(Phonetic::class,
		function(Faker $faker) {
			return [
				'text_description' => $faker->asciify(str_repeat('*', random_int(1, 12))),
			];
		});
