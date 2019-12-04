<?php

	/**
	 * @var Factory $factory
	 */

	use App\Context;
	use Faker\Generator as Faker;
	use Illuminate\Database\Eloquent\Factory;

	$factory->define(Context::class,
		function(Faker $faker) {
			return [
				'context_to_string' => $faker->sentence(),
			];
		});
