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
        $card->definition= 'this is the definition test';
        $card->owner_id="5";
        $card->save();
        $this->assertDatabaseHas('cards', [
            'card_id' => $card->card_id,
            'heading' => $card->heading,
            'language_id' => strval($card->language_id),
            'definition' => $card->definition,
            'owner_id' => strval($card->owner_id),
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
        $card->definition= 'this is the definition test';
        $card->owner_id="5";
        $card->update();
        $this->assertDatabaseHas('cards', [
            'card_id' => $card->card_id,
            'heading' => $card->heading,
            'language_id' => strval($card->language_id),
            'definition' => $card->definition,
            'owner_id' => strval($card->owner_id),
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
        $card->definition= 'this is the definition test';
        $card->owner_id="5";
        $card->save();
        $card->delete();
        $this->assertDatabaseMissing('cards', [
            'card_id' => $card->card_id,
            'heading' => $card->heading,
            'language_id' => strval($card->language_id),
            'definition' => $card->definition,
            'owner_id' => strval($card->owner_id),
        ]);
    }
}