<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Definition;
use Faker\Generator as Faker;

$factory->define(Definition::class, function (Faker $faker) {
	return [
		'definition_content' => $faker->sentence(),
	];
});
