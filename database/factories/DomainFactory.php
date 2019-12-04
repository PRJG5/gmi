<?php

	/**
	 * @var Factory $factory
	 */

	use App\Domain;
	use Faker\Generator as Faker;
	use Illuminate\Database\Eloquent\Factory;

	$factory->define(Domain::class,
		function(Faker $faker) {
			do {
				$content = ucfirst($faker->unique()->word);
			} while(Domain::where('content', $content)->get()->count() > 0);
			return [
				'content' => $content,
			];
		});
