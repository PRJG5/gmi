<?php

	/**
	 * @var Factory $factory
	 */

	use App\Language;
	use App\SpokenLanguages;
	use App\User;
	use Faker\Generator as Faker;
	use Illuminate\Database\Eloquent\Factory;

	$factory->define(SpokenLanguages::class,
		function(Faker $faker) {
			do {
				$user = User::all()->random()->id;
				$lang = Language::all()->random()->id;
			} while(SpokenLanguages::where('language_ISO', $lang)->where('user_id', $user)->get()->count() > 0);
			return [
				'user_id'      => $user,
				'language_ISO' => $lang,
			];
		});
