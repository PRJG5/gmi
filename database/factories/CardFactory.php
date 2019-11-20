<?php

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */

use App\Card;
use App\User;
use Faker\Generator as Faker;
use App\Enums\Language;

$factory->define(Card::class, function (Faker $faker) {
    return [
        'heading' => $faker->text(100),
        'language_id' => Language::getRandomValue(),
        'owner_id' => User::all()->random()->id,
    ];
});
