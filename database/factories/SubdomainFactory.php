<?php

	/**
	 * @var Factory $factory
	 */

	use App\Subdomain;
	use Faker\Generator as Faker;
	use Illuminate\Database\Eloquent\Factory;

	$factory->define(Subdomain::class,
		function(Faker $faker) {
			do {
				$subdomain = ucfirst($faker->unique()->word);
			} while(Subdomain::where('content', $subdomain)->get()->count() > 0);
			return [
				'content' => $subdomain,
			];
		});
