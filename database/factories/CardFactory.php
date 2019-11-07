<?php

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */

use App\Card;
use App\User;
use Faker\Generator as Faker;
use App\Enums\Language;
use App\Phonetic;

$factory->define(Card::class, function (Faker $faker) {
    return [
		// card_id is the primary key, as auto-increment, and should not be provided
        'card_id' => $faker->unique()->randomNumber(),
        'heading' => $faker->text(100),
        'language_id' => Language::getRandomValue(),
        'owner_id' => User::all()->random()->id,
        'phonetic_id' => $faker->unique()->randomNumber(),
    ];
});
