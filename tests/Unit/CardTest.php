<?php

namespace Tests\Unit;

use App\Link;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;

use App\Card as Card;
use App\Phonetic;
use App\User as User;
use App\Note;
use App\Context;
use App\Definition;
use App\Validation;

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
        $heading = "My Card";
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
        ]);
        $owner->save();
        $validation = new Validation();
        $validation->save();
		$card = new Card();
		$card->heading = $heading;
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = 'ARA';
        $card->owner_id =  User::where('email', $owner->email)->first()->id;
        $card->validation_id = $validation->id; 
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
            'validation_id' => $card->validation_id,
        ]);
		$card->heading = 'My New Card';
		$card->update();
        
        $this->assertDatabaseMissing('cards', [
            'id'			=> $card->id,
            'heading'		=> $heading,
            'phonetic_id'	=> $card->phonetic_id,
            'domain_id'		=> strval($card->domain_id),
            'subdomain_id'	=> strval($card->subdomain_id),
            'definition_id' => $card->definition_id,
            'note_id'		=> $card->note_id,
            'context_id'	=> $card->context_id,
            'language_id'	=> strval($card->language_id),
            'owner_id'		=> $card->owner_id,
            'validation_id' => $card->validation_id,
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
        $validation = new Validation();
        $validation->save();
		$card = new Card();
		$card->heading = 'hello';
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = 'ARA';
        $card->owner_id = User::where('email', $owner->email)->first()->id;
        $card->validation_id = $validation->id; 
        $card->save();
        $card->heading = NULL;
        $this->expectException(QueryException::class);
        $card->update();
        
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
            'validation_id' => $card->validation_id,
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
        $validation = new Validation();
        $validation->save();
		$card = new Card();
		$card->heading = 'hello';
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = 'ARA';
        $card->owner_id = User::where('email', $owner->email)->first()->id;
        $card->validation_id = $validation->id; 
        $card->save();
        $card->language_id = NULL;
        $this->expectException(QueryException::class);
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
            'language_id'	=> strval('ARA'),
            'owner_id'		=> $card->owner_id,
            'validation_id' => $card->validation_id,
        ]);
    }


     /**
     * Test if the updated card without validation throw an exception.
     * @return void
     * @author 49222, 44424
     * @test
     */
    public function editCardWithoutValidationNotOKTest()
    {
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
        ]);
        $owner->save();
        $validation = new Validation();
        $validation->save();
		$card = new Card();
		$card->heading = 'hello';
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = 'ARA';
        $card->owner_id = User::where('email', $owner->email)->first()->id;
        $card->validation_id = $validation->id; 
        $card->save();
        $card->validation_id = NULL;
        $this->expectException(QueryException::class);
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
            'language_id'	=> strval('ARA'),
            'owner_id'		=> $card->owner_id,
            'validation_id' => $validation->id,
        ]);
    }

     /**
     * Test if the updated card without validation throw an exception.
     * @return void
     * @author 49222, 44424
     * @test
     */
    public function editCardWithValidationOKTest()
    {
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
        ]);
        $owner->save();
        $validation = new Validation();
        $validation->save();
        $validationB = new Validation();
        $validationB->save();
		$card = new Card();
		$card->heading = 'hello';
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = 'ARA';
        $card->owner_id = User::where('email', $owner->email)->first()->id;
        $card->validation_id = $validation->id; 
        $card->save();
        $card->validation_id = $validationB->id;
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
            'language_id'	=> strval('ARA'),
            'owner_id'		=> $card->owner_id,
            'validation_id' => $validationB->id,
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
        $validation = new Validation();
        $validation->save();
        $owner_id = User::where('email', $owner->email)->first()->id;
		$card = new Card();
		$card->heading = 'hello';
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = 'ARA';
        $card->owner_id = $owner_id;
        $card->validation_id = $validation->id;
        $card->save();
        $card->owner_id = NULL;
        $this->expectException(QueryException::class);
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
            'owner_id'		=> $owner_id,
            'validation_id' => $card->validation_id,
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
        $heading = "My Card";
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
        ]);
        $owner->save();
        $validation = new Validation();
        $validation->save();
		$card = new Card();
		$card->heading = $heading;
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = 'ARA';
        $card->owner_id =  User::where('email', $owner->email)->first()->id;
        $card->validation_id = $validation->id;
        $card->save();

        $phonetic = new Phonetic();
        $phonetic->textDescription = 'helloPhonetic';
        $phonetic->save();

        $note = new Note();
        $note->description = 'hellloNote';
        $note->save();

        $context = new Context();
        $context->context_to_string = 'helloContext';
        $context->save();

        $definition = new Definition();
        $definition->definition_content = 'helloDefinition';
        $definition->save();

		$card->phonetic_id = Phonetic::where('textDescription', $phonetic->textDescription)->first()->id;
        $card->definition_id = Definition::where('definition_content', $definition->definition_content)->first()->id;
        $card->context_id = Context::where('context_to_string',  $context->context_to_string)->first()->id;
        $card->note_id = Note::where('description', $note->description)->first()->id;
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
            'validation_id' => $card->validation_id,
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
            'validation_id' => $card->validation_id,
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
        $heading = "My Card";
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
        ]);
        $owner->save();
        

        $phonetic = new Phonetic();
        $phonetic->textDescription = 'helloPhonetic';
        $phonetic->save();

        $note = new Note();
        $note->description = 'hellloNote';
        $note->save();

        $context = new Context();
        $context->context_to_string = 'helloContext';
        $context->save();

        $definition = new Definition();
        $definition->definition_content = 'helloDefinition';
        $definition->save();

        $validation = new Validation();
        $validation->save();


		$card = new Card();
		$card->heading = $heading;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->language_id = 'ARA';
        $card->owner_id =  User::where('email', $owner->email)->first()->id;

		$card->phonetic_id = Phonetic::where('textDescription', $phonetic->textDescription)->first()->id;
        $card->definition_id = Definition::where('definition_content', $definition->definition_content)->first()->id;
        $card->context_id = Context::where('context_to_string',  $context->context_to_string)->first()->id;
        $card->note_id = Note::where('description', $note->description)->first()->id;
        $card->validation_id = $validation->id;
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
            'validation_id' => $card->validation_id,
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
        $validation = new Validation();
        $validation->save();
        $owner->save();
		$card = new Card();
		$card->heading = NULL;
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = 'ARA';
        $card->owner_id = User::where('email', $owner->email)->first()->id;
        $card->validation_id;
        
        $this->expectException(QueryException::class);
        $card->save();
    }


    /**
     * Test if the created card without validation_id throw an exception.
     * @return void
     * @author 49222, 44424
     * @test
     */
    public function createCardWithoutValidationNotOKTest()
    {
		$owner = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
        ]);
        $owner->save();
		$card = new Card();
		$card->heading = NULL;
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = 'ARA';
        $card->owner_id = User::where('email', $owner->email)->first()->id;
        $card->validation_id = NULL;
        
        $this->expectException(QueryException::class);
        $card->save();

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
            'validation_id' => $card->validation_id,
        ]);
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
        $validation = new Validation();
        $validation->save();
        $owner->save();
		$card = new Card();
		$card->heading = 'hello';
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = NULL;
        $card->owner_id = User::where('email', $owner->email)->first()->id;
        $card->validation_id = $validation->id;
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
        $validation = new Validation();
        $validation->save();
		$card = new Card();
		$card->heading = 'hello';
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = 'ARA';
        $card->owner_id = NULL;
        $card->validation_id = $validation->id;
        $this->expectException(QueryException::class);
        $card->save();
    }

    

    /**
     * Test if the card can be deleted
     * @return void
     * @throws \Exception if card cannot be deleted
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
        $validation = new Validation();
        $validation->save();
		$card = new Card();
		$card->heading = 'My Card';
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = 'ARA';
        $card->owner_id = User::where('email', $owner->email)->first()->id;
        $card->validation_id = $validation->id;
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
            'validation_id'    => $card->validation_id
		]);
    }

    /**
     * Test if the card can be deleted. Don't do test, because Eloquent don't throw exception if delete many times
     * @return void
     * @throws \Exception Don't do test, because Eloquent don't throw exception if delete many times
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
        $validation = new Validation();
        $validation->save();
		$card = new Card();
		$card->heading = 'My Card';
		$card->phonetic_id = NULL;
		$card->domain_id = 'Legal';
		$card->subdomain_id = 'Justice';
        $card->definition_id = NULL;
        $card->context_id = NULL;
        $card->note_id = NULL;
        $card->language_id = 'ARA';
        $card->owner_id = User::where('email', $owner->email)->first()->id;
        $card->validation_id = $validation->id;
        $card->save();
        $card->id = Card::where('heading', $card->heading)->first()->id;
        Card::destroy($card->id);
        //$this->expectException(QueryException::class); //NOTE: Eloquent don't throw exception if delete many times
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
	// 	$card->heading = 'My Card';
	// 	$card->phonetic_id = NULL;
	// 	$card->domain_id = 'Legal';
	// 	$card->subdomain_id = 'Justice';
    //     $card->definition_id = NULL;
    //     $card->context_id = NULL;
    //     $card->note_id = NULL;
    //     $card->language_id = 'ARA';
    //     $card->owner_id = User::where('email', $user->email)->first()->id;
    //     $card->save();
    //     $card = new Card();
	// 	$card->heading = 'My second card';
	// 	$card->phonetic_id = NULL;
	// 	$card->domain_id = 'Legal';
	// 	$card->subdomain_id = 'Justice';
    //     $card->definition_id = NULL;
    //     $card->context_id = NULL;
    //     $card->note_id = NULL;
    //     $card->language_id = 'ARA';
    //     $card->save();
    
    //     $link = new Link();
    //     $link->cardA = Card::where('heading', 'My Card')->first()->id;
    //     $link->cardB = Card::where('heading', 'My second card')->first()->id;
    //     $link->save();
        
	// 	$this->assertDatabaseHas('links', [
    //         'id'            => $link->id,
    //         'cardA'			=> $link->cardA,
    //         'cardB'		    => $link->cardB,
    //     ]);
    // }
}
