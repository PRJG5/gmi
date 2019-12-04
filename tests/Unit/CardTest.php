<?php

namespace Tests\Unit;

use App\Link;
use Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;

use App\Card as Card;
use App\Phonetic;
use App\User as User;
use App\Note;
use App\Context;
use App\Definition;

class CardTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * Test if the card's new values has been correctly updated in DB, and checks if the old values isn't in DB
	 * @return void
	 * @author 43268, 49102, 43121
	 * @test
	 */
	public function editCardOKTest()
	{
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
		]);
		$owner->save();
		$card = new Card([
			'heading' => 'My Card',
			'phonetic_id' => NULL,
			'domain_id' => 'Legal',
			'subdomain_id' => 'Justice',
			'definition_id' => NULL,
			'context_id' => NULL,
			'note_id' => NULL,
			'language_id' => 'ARA',
			'owner_id' => $owner->id,
		 ]);
		$card->save();
		$card->update([
			'heading' => 'My New Card',
		]);
		$this->assertDatabaseHas('cards', [
			'id'			=> $card->id,
			'heading'		=> 'My New Card',
			'phonetic_id'	=> $card->phonetic_id,
			'domain_id'		=> strval($card->domain_id),
			'subdomain_id'	=> strval($card->subdomain_id),
			'definition_id' => $card->definition_id,
			'note_id'		=> $card->note_id,
			'context_id'	=> $card->context_id,
			'language_id'	=> strval($card->language_id),
			'owner_id'		=> $card->owner_id,
		]);
		$this->assertDatabaseMissing('cards', [
			'id'			=> $card->id,
			'heading'		=> 'My Card',
			'phonetic_id'	=> $card->phonetic_id,
			'domain_id'		=> strval($card->domain_id),
			'subdomain_id'	=> strval($card->subdomain_id),
			'definition_id' => $card->definition_id,
			'note_id'		=> $card->note_id,
			'context_id'	=> $card->context_id,
			'language_id'	=> strval($card->language_id),
			'owner_id'		=> $card->owner_id,
		]);
	}

	/**
	 * Test if the updated card without heading throw an exception.
	 * @return void
	 * @author 49102, 43121
	 * @test
	 */
	public function editCardWithoutHeadingNotOKTest()
	{
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
		]);
		$owner->save();
		$card = new Card([
			'heading' => 'hello',
			'phonetic_id' => NULL,
			'domain_id' => 'Legal',
			'subdomain_id' => 'Justice',
			'definition_id' => NULL,
			'context_id' => NULL,
			'note_id' => NULL,
			'language_id' => 'ARA',
			'owner_id' => $owner->id,
		]);
		$card->save();
		$this->expectException(QueryException::class);
		$card->update([
			'heading' => NULL,
		]);
		$this->assertDatabaseHas('cards', [
			'id'			=> $card->id,
			'heading'		=> 'hello',
			'phonetic_id'	=> $card->phonetic_id,
			'domain_id'		=> strval($card->domain_id),
			'subdomain_id'	=> strval($card->subdomain_id),
			'definition_id' => $card->definition_id,
			'note_id'		=> $card->note_id,
			'context_id'	=> $card->context_id,
			'language_id'	=> strval($card->language_id),
			'owner_id'		=> $card->owner_id,
		]);
	}

 /**
	 * Test if the updated card without language throw an exception.
	 * @return void
	 * @author 49102, 43121
	 * @test
	 */
	public function editCardWithoutLanguageNotOKTest()
	{
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
		]);
		$owner->save();
		$card = new Card([
			'heading' => 'hello',
			'phonetic_id' => NULL,
			'domain_id' => 'Legal',
			'subdomain_id' => 'Justice',
			'definition_id' => NULL,
			'context_id' => NULL,
			'note_id' => NULL,
			'language_id' => 'ARA',
			'owner_id' => $owner->id,
		]);
		$card->save();
		$this->expectException(QueryException::class);
		$card->update([
			'language_id' => NULL,
		]);
		
		$this->assertDatabaseHas('cards', [
			'id'			=> $card->id,
			'heading'		=> $card->heading,
			'phonetic_id'	=> $card->phonetic_id,
			'domain_id'		=> strval($card->domain_id),
			'subdomain_id'	=> strval($card->subdomain_id),
			'definition_id' => $card->definition_id,
			'note_id'		=> $card->note_id,
			'context_id'	=> $card->context_id,
			'language_id'	=> strval('ARA'),
			'owner_id'		=> $card->owner_id,
		]);
	}

	 /**
	 * Test if the updated card without owner throw an exception.
	 * @return void
	 * @author 49102, 43121
	 * @test
	 */
	public function editCardWithoutOwnerNotOKTest()
	{
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
		]);
		$owner->save();
		$card = new Card([
			'heading' => 'hello',
			'phonetic_id' => NULL,
			'domain_id' => 'Legal',
			'subdomain_id' => 'Justice',
			'definition_id' => NULL,
			'context_id' => NULL,
			'note_id' => NULL,
			'language_id' => 'ARA',
			'owner_id' => $owner->id,
		]);
		$card->save();
		$this->expectException(QueryException::class);
		$card->update([
			'owner_id' => NULL,
		]);
		
		$this->assertDatabaseHas('cards', [
			'id'			=> $card->id,
			'heading'		=> $card->heading,
			'phonetic_id'	=> $card->phonetic_id,
			'domain_id'		=> strval($card->domain_id),
			'subdomain_id'	=> strval($card->subdomain_id),
			'definition_id' => $card->definition_id,
			'note_id'		=> $card->note_id,
			'context_id'	=> $card->context_id,
			'language_id'	=> strval($card->language_id),
			'owner_id'		=> $owner->id,
		]);
	}

	/**
	 * Test if the card's new values has been correctly updated in DB, and checks if all data are filled.
	 * @return void
	 * @author 49102, 43121
	 * @test
	 */
	public function editCardWithAllValuesSetOKTest()
	{
		$heading = 'My Card';
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
		]);
		$owner->save();
		$card = new Card([
			'heading' => $heading,
			'phonetic_id' => NULL,
			'domain_id' => 'Legal',
			'subdomain_id' => 'Justice',
			'definition_id' => NULL,
			'context_id' => NULL,
			'note_id' => NULL,
			'language_id' => 'ARA',
			'owner_id' =>  $owner->id,
		]);
		$card->save();
		$phonetic = new Phonetic([
			'text_description' => 'helloPhonetic',
		]);
		$phonetic->save();

		$note = new Note([
			'description' => 'helloNote',
		]);
		$note->save();

		$context = new Context([
			'context_to_string' => 'helloContext',
		]);
		$context->save();

		$definition = new Definition([
			'definition_content' => 'helloDefinition',
		]);
		$definition->save();

		$card->update([
			'phonetic_id' => $phonetic->id,
			'definition_id' => $definition->id,
			'context_id' => $context->id,
			'note_id' => $note->id,
		]);
		$this->assertDatabaseHas('cards', [
			'id'			=> $card->id,
			'heading'		=> $card->heading,
			'phonetic_id'	=> $card->phonetic_id,
			'domain_id'		=> strval($card->domain_id),
			'subdomain_id'	=> strval($card->subdomain_id),
			'definition_id' => $card->definition_id,
			'note_id'		=> $card->note_id,
			'context_id'	=> $card->context_id,
			'language_id'	=> strval($card->language_id),
			'owner_id'		=> $card->owner_id,
		]);
		$this->assertDatabaseMissing('cards', [
			'id'			=> $card->id,
			'heading'		=> $heading,
			'phonetic_id'	=> NULL,
			'domain_id'		=> strval($card->domain_id),
			'subdomain_id'	=> strval($card->subdomain_id),
			'definition_id' => NULL,
			'note_id'		=> NULL,
			'context_id'	=> NULL,
			'language_id'	=> strval($card->language_id),
			'owner_id'		=> $card->owner_id,
		]);
	}


	/**
	 * Test if we can create a card with all values set.
	 * @return void
	 * @author 49102, 43121
	 * @test
	 */
	public function createCardWithAllValuesSetOKTest()
	{
		$heading = 'My Card';
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
		]);
		$owner->save();
		

		$phonetic = new Phonetic([
			'text_description' => 'helloPhonetic',
		]);

		$phonetic->save();

		$note = new Note([
			'description' => 'helloNote',
		]);
		$note->save();

		$context = new Context([
			'context_to_string' => 'helloContext',
		]);
		$context->save();

		$definition = new Definition([
			'definition_content' => 'helloDefinition',
		]);
		$definition->save();


		$card = new Card([
			'heading' => $heading,
			'domain_id' => 'Legal',
			'subdomain_id' => 'Justice',
			'language_id' => 'ARA',
			'owner_id' =>  $owner->id,

			'phonetic_id' => $phonetic->id,
			'definition_id' => $definition->id,
			'context_id' => $context->id,
			'note_id' => $note->id,
		]);
		
		$card->save();
		$this->assertDatabaseHas('cards', [
			'id'			=> $card->id,
			'heading'		=> $card->heading,
			'phonetic_id'	=> $card->phonetic_id,
			'domain_id'		=> strval($card->domain_id),
			'subdomain_id'	=> strval($card->subdomain_id),
			'definition_id' => $card->definition_id,
			'note_id'		=> $card->note_id,
			'context_id'	=> $card->context_id,
			'language_id'	=> strval($card->language_id),
			'owner_id'		=> $card->owner_id,
		]);
	}

	/**
	 * Test if the created card without heading throw an exception.
	 * @return void
	 * @author 49102, 43121
	 * @test
	 */
	public function createCardWithoutHeadingNotOKTest()
	{
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
		]);
		$owner->save();
		$card = new Card([
			'heading' => NULL,
			'phonetic_id' => NULL,
			'domain_id' => 'Legal',
			'subdomain_id' => 'Justice',
			'definition_id' => NULL,
			'context_id' => NULL,
			'note_id' => NULL,
			'language_id' => 'ARA',
			'owner_id' => $owner->id,
		]);
		
		$this->expectException(QueryException::class);
		$card->save();
	}

 /**
	 * Test if the created card without language throw an exception.
	 * @return void
	 * @author 49102, 43121
	 * @test
	 */
	public function createCardWithoutLanguageNotOKTest()
	{
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
		]);
		$owner->save();
		$card = new Card([
			'heading' => 'hello',
			'phonetic_id' => NULL,
			'domain_id' => 'Legal',
			'subdomain_id' => 'Justice',
			'definition_id' => NULL,
			'context_id' => NULL,
			'note_id' => NULL,
			'language_id' => NULL,
			'owner_id' => $owner->id,
		]);
		$this->expectException(QueryException::class);
		$card->save();
	}

	 /**
	 * Test if the create card without owner throw an exception.
	 * @return void
	 * @author 49102, 43121
	 * @test
	 */
	public function createCardWithoutOwnerNotOKTest()
	{
		$card = new Card([
			'heading' => 'hello',
			'phonetic_id' => NULL,
			'domain_id' => 'Legal',
			'subdomain_id' => 'Justice',
			'definition_id' => NULL,
			'context_id' => NULL,
			'note_id' => NULL,
			'language_id' => 'ARA',
			'owner_id' => NULL,
		]);
		$this->expectException(QueryException::class);
		$card->save();
	}


	/**
	 * Test if the card can be deleted
	 * @return void
	 * @throws Exception if card cannot be deleted
	 * @author 43268, 49102, 43121
	 * @test
	 */
	public function deleteOKCardTest()
	{
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
		]);
		$owner->save();
		$card = new Card([
			'heading' => 'My Card',
			'phonetic_id' => NULL,
			'domain_id' => 'Legal',
			'subdomain_id' => 'Justice',
			'definition_id' => NULL,
			'context_id' => NULL,
			'note_id' => NULL,
			'language_id' => 'ARA',
			'owner_id' => $owner->id,
		]);
		$card->save();
		$card->delete();
		$this->assertDatabaseMissing('cards', [
			'id'			=> $card->id,
			'heading'		=> $card->heading,
			'phonetic_id'	=> $card->phonetic_id,
			'domain_id'		=> strval($card->domain_id),
			'subdomain_id'	=> strval($card->subdomain_id),
			'definition_id' => $card->definition_id,
			'note_id'		=> $card->note_id,
			'context_id'	=> $card->context_id,
			'language_id'	=> strval($card->language_id),
			'owner_id'		=> $card->owner_id,
		]);
	}

	/**
	 * Test if the card can be deleted. Don't do test, because Eloquent don't throw exception if delete many times
	 * @return void
	 * @throws Exception Don't do test, because Eloquent don't throw exception if delete many times
	 * @author 49102, 43121
	 * @test
	 */
	public function deleteNotExistingCardNotOkTest()
	{
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
		]);
		$owner->save();
		$card = new Card([
			'heading' => 'My Card',
			'phonetic_id' => NULL,
			'domain_id' => 'Legal',
			'subdomain_id' => 'Justice',
			'definition_id' => NULL,
			'context_id' => NULL,
			'note_id' => NULL,
			'language_id' => 'ARA',
			'owner_id' => $owner->id,
		 ]);
		$card->save();
		Card::destroy($card->id);
		// $this->expectException(QueryException::class); //NOTE: Eloquent don't throw exception if delete many times
		Card::destroy($card->id);
	}

	// /**
	//  * @author 49102 43121
    //  * @test
    //  *  Link two cards ok
    //  */
    // public function linksCardsOkTest()
    // {
    //     $user = new User([
	// 		'name'		=> 'Tester',
	// 		'email'		=> 'tester@test.com',
	// 		'password'	=> 'tested',
    //     ]);
    //     $user->save();

    //     $card = new Card();
	// 	'heading' => 'My Card',
	// 	'phonetic_id' => NULL,
	// 	'domain_id' => 'Legal',
	// 	'subdomain_id' => 'Justice',
    //     'definition_id' => NULL,
    //     'context_id' => NULL,
    //     'note_id' => NULL,
    //     'language_id' => 'ARA',
    //     'owner_id' => User::where('email', $user->email)->first()->id,
    //     $card->save();
    //     $card = new Card();
	// 	'heading' => 'My second card',
	// 	'phonetic_id' => NULL,
	// 	'domain_id' => 'Legal',
	// 	'subdomain_id' => 'Justice',
    //     'definition_id' => NULL,
    //     'context_id' => NULL,
    //     'note_id' => NULL,
    //     'language_id' => 'ARA',
    //     $card->save();
    
    //     $link = new Link();
    //     'card_a' => Card::where('heading', 'My Card')->first()->id,
    //     'card_b' => Card::where('heading', 'My second card')->first()->id,
    //     $link->save();
        
	// 	$this->assertDatabaseHas('links', [
    //         'id'            => $link->id,
    //         'card_a'			=> $link->card_a,
    //         'card_b'		    => $link->card_b,
    //     ]);
    // }
}
