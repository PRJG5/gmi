<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Context;
use Faker\Generator as Faker;

$factory->define(Context::class, function (Faker $faker) {
    return [
        'context_to_string' => $faker->sentence()
    ];
});
