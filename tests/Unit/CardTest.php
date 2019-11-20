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
        $card->phonetic_id = 5;
        $card->save();
        $this->assertDatabaseHas('cards', [
            'card_id' => "1",
            'heading' => $card->heading,
            'language_id' => strval($card->language_id),
            'phonetic_id'=> 5,
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
        $card->phonetic_id = 5;
        $card->save();
        $card->heading = 'My New Card';
        $card->update();
        $this->assertDatabaseHas('cards', [
            'card_id' => "1",
            'heading' => $card->heading,
            'language_id' => strval($card->language_id),
            'phonetic_id'=> 5,
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
}