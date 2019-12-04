<?php

	/**
	 * @var Factory $factory
	 */

	use App\Card;
	use App\Context;
	use App\Definition;
	use App\Domain;
	use App\Language;
	use App\Note;
	use App\Phonetic;
	use App\Subdomain;
	use App\User;
	use Faker\Generator as Faker;
	use Illuminate\Database\Eloquent\Factory;

	$factory->define(Card::class,
		function(Faker $faker) {

			$phonetic = factory(Phonetic::class)->create();
			$definition = factory(Definition::class)->create();
			$context = factory(Context::class)->create();
			$note = factory(Note::class)->create();

			return [
				'heading'       => ucfirst($faker->word),
				'phonetic_id'   => $phonetic->id,
				'domain_id'     => Domain::all()->random()->id,
				'subdomain_id'  => Subdomain::all()->random()->id,
				'definition_id' => $definition->id,
				'context_id'    => $context->id,
				'note_id'       => $note->id,
				'language_id'   => Language::all()->random()->slug,
				'owner_id'      => User::all()->random()->id,
			];
		});
