<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Phonetic;
use Faker\Generator as Faker;

$factory->define(Phonetic::class, function (Faker $faker) {
	return [
		'text_description' => $faker->asciify('***********'),
	];
});
