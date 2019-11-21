<?php

namespace Tests\Unit;

use App\Link;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Card as Card;
use App\User as User;

class CardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create a card.
     * @return void
     * @author 43268
     * @test
     */
    public function createCardTest()
    {
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'test@test.com',
			'password'	=> 'test',
		]);
        $card = new Card();
		$card->heading = 'My Card';
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = 'ARA';
        $card->owner_id = $owner->id;
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
     * @return void
     * @author 43268
     * @test
     */
    public function editCardTest()
    {
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'test@test.com',
			'password'	=> 'test',
		]);
		$card = new Card();
		$card->heading = 'My Card';
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = 'ARA';
        $card->owner_id = $owner->id;
		$card->save();
		$card->heading = 'My New Card';
		$card->update();
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
     * @return void
     * @throws \Exception if card cannot be deleted
     * @author 43268
     * @test
     */
    public function deleteCard()
    {
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'test@test.com',
			'password'	=> 'test',
		]);
		$card = new Card();
		$card->heading = 'My Card';
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = 'ARA';
        $card->owner_id = $owner->id;
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
	 * @author 49222
     * @test
	 */
    public function getLinks()
    {
        $user = new User([
			'name'		=> 'Tester',
			'email'		=> 'tester@test.com',
			'password'	=> 'tested',
		]);
        $cardA =  new User([
			'heading'		=> 'test1',
			'definition'	=> 'blabla2',
			'owner_id'		=> $user->id
		]);
        $cardB =  new User([
			'heading'		=> 'test2',
			'definition'	=> 'blabla2',
			'owner_id'		=> $user->id
		]);
        $link = new Link();
        $link->cardA = $cardA->id;
        $link->cardB = $cardB->id;
        $link->save();
        $this->assertEquals($cardA->links(), [$cardB]);
    }
}
