<?php

	/**
	 * @var Factory $factory
	 */

	use App\Definition;
	use Faker\Generator as Faker;
	use Illuminate\Database\Eloquent\Factory;

	$factory->define(Definition::class,
		function(Faker $faker) {
			return [
				'definition_content' => $faker->sentence(),
			];
		});
