<?php

	/**
	 * @var Factory $factory
	 */

	use App\User;
	use Faker\Generator as Faker;
	use Illuminate\Database\Eloquent\Factory;
	use Illuminate\Support\Facades\Hash;
	use Illuminate\Support\Str;

	$factory->define(User::class,
		function(Faker $faker) {
			return [
				'name'              => $faker->name,
				'email'             => $faker->unique()->safeEmail,
				'email_verified_at' => now(),
				'password'          => Hash::make($faker->password(8)),
				'remember_token'    => Str::random(10),
				'role'              => $faker->numberBetween(0, 2),
				'api_token'         => NULL,
			];
		});
