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
     * @Test
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateACardWithDefinition()
    {
        $card = new Card();
        $definition = new Definition();
        $definition->definition_content = "hello33";
        $definition->save();
        $this->assertDatabaseHas('definitions', [
            'definition_content' => $definition->definition_content;
        ]);
    }
}
