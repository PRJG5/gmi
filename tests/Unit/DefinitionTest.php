<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Card as Card;
use App\Definition as Definition;

class DefinitionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateACardWithDefinition()
    {
        $card = new Card();
        $definition = new Definition();
        $definition->definition_content = "hello33";
        $definition->card = 1;
        $card->heading = 'My Card';
        $card->language_id = "1";
        $card->save();
        $this->assertDatabaseHas('cards', [
            'card_id' => "1",
            'heading' => $card->heading,
            'language_id' => strval($card->language_id),
        ]);
    }
}
