<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use App\Card as Card;

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
        $card = new Card();
        $card->heading = 'My Card';
        $card->language_id = "1";
        $card->save();
        $this->assertDatabaseHas('cards', [
            'card_id' => "1",
            'heading' => $card->heading,
            'language_id' => strval($card->language_id),
        ]);
    }

    /**
     * @return void
     * @author 43268
     * @test
     */
    public function editCardTest()
    {
        $card = new Card();
        $card->heading = 'My Card';
        $card->language_id = "1";
        $card->save();
        $card->heading = 'My New Card';
        $card->update();
        $this->assertDatabaseHas('cards', [
            'card_id' => "1",
            'heading' => $card->heading,
            'language_id' => strval($card->language_id),
        ]);
    }

    /**
     * @return void
     * @author 43268
     * @test
     */
    public function deleteCard()
    {
        $card = new Card();
        $card->heading = 'My Card';
        $card->language_id = "1";
        $card->save();
        $card->delete();
        $this->assertDatabaseMissing('cards', [
            'card_id' => "1",
            'heading' => $card->heading,
            'language_id' => strval($card->language_id),
        ]);
    }

    public function getLinks()
    {
        $cardA = Card::create(['heading'=>'test1', 'definition'=>'blabla2']);
        $cardB = Card::create(['heading'=>'test2', 'definition'=>'blabla2']);
        $link = new Link();
        $link->cardA = $cardA->card_id;
        $link->cardB = $cardB->card_id;
        $link->save();
        $this->assertEquals($cardA->links(), [$cardB]);
    }
}