<?php

/**
 * @var Factory $factory
 */

use App\Card;
use App\Context;
use App\Definition;
use App\Enums\Domain;
use App\Enums\Language;
use App\Enums\Subdomain;
use App\Note;
use App\Phonetic;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Card::class, function (Faker $faker) {
	$phonetic =		factory(Phonetic::class)->create();
	$definition =	factory(Definition::class)->create();
	$context =		factory(Context::class)->create();
	$note =			factory(Note::class)->create();
	return [
		'heading' =>		$faker->text(100),
		'phonetic_id' =>	$phonetic->id,
		'domain_id' =>		Domain::getRandomValue(),
		'subdomain_id' =>	Subdomain::getRandomValue(),
		'definition_id' =>	$definition->id,
		'context_id' =>		$context->id,
		'note_id' =>		$note->id,
		'language_id' =>	Language::getRandomValue(),
		'owner_id' =>		User::all()->random()->id,
	];
});
