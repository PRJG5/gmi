<?php

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */

use App\Card;
use App\User;
use Faker\Generator as Faker;

$factory->define(Card::class, function (Faker $faker) {
    /*
     List of languages with non-latin alphabets
     supported by the Faker library.
     Faker doesn't support
     * Pashtu
     * Urdu
    */
    $testLanguages = [
        'en_US', // English, United States
        'ar_SA', // Arabic, Saudi Arabia
        'hy_AM', // Armenian, Armenian              → doesn't ouput text in language
        'zh_CN', // Mandarin (Chinese), China       → doesn't ouput text in language
        'fa_IR', // Farsi, Iran
        'ka_GE', // Georgian, Georgia
        'el_GR', // Greek, Greece
        'he_IL', // Hebrew, Israel                  → doesn't ouput text in language
        'ja_JP', // Japanese, Japan
        'ko_KR', // Korean, Korea
        'mn_MN', // Mongolian, Mongolian            → doesn't ouput text in language
        'ne_NP', // Nepali, Nepal                   → doesn't ouput text in language
        'ru_RU', // Russian, Russia
        'uk_UA', // Ukrainian, Ukraine
    ];
    $pickedLanguage = rand(0, sizeof($testLanguages) - 1);

    //$faker->locale = $testLanguages[$pickedLanguage];
    $faker = \Faker\Factory::create($testLanguages[$pickedLanguage]);

    return [
        'card_id' => $faker->unique()->randomDigit,
        'heading' => $faker->realText() . " ($testLanguages[$pickedLanguage])",
        'language_id' => $pickedLanguage,
        'owner_id' => User::all()->random()->id,
    ];
});
