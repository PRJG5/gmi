<?php

	/**
	 * @var Factory $factory
	 */

	use App\Language;
	use Faker\Generator as Faker;
	use Illuminate\Database\Eloquent\Factory;

	$factory->define(Language::class,
		function(Faker $faker) {
			do {
				$lang = $faker->lexify(str_repeat('?', random_int(4, 15)));
			} while(Language::where('slug', strtoupper(substr($lang, 0, 3)))->get()->count() > 0);
			return [
				'content' => ucfirst($lang),
				'slug'    => strtoupper(substr($lang, 0, 3)),
			];
		});
