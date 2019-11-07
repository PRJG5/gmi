<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Link;
use App\Card;

class LinkTest extends TestCase
{
    // /**
    //  * A basic unit test example.
    //  *
    //  * @return void
    //  */
    // public function testExample()
    // {
    //     $this->assertTrue(true);
    // }
    public function testGetA()
    {
        $cardA = Card::create(['heading'=>'test1']);
        $cardB = Card::create(['heading'=>'test2']);
        $link = new Link();
        $link->cardA = $cardA->card_id;
        $link->cardB = $cardB->card_id;
        $link->save();
        $this->assertEquals($link->getCardA(), $cardA);
        $this->assertEquals($link->getCardB(), $cardB);
    }
}

