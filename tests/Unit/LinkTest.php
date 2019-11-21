<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Link;
use App\Card;
use App\User;

class LinkTest extends TestCase
{
    use RefreshDatabase;

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
        $user = User::create(["name"=>"Tester","email"=>"tester@test.com","password"=>"tested"]);
        $cardA = Card::create(['heading'=>'test1', 'definition'=>'blabla2', 'owner_id'=>$user->id]);
        $cardB = Card::create(['heading'=>'test2', 'definition'=>'blabla2', 'owner_id'=>$user->id]);
        $link = new Link();
        $link->cardA = $cardA->id;
        $link->cardB = $cardB->id;
        $link->save();
        $this->assertEquals($link->getCardA()->id, $cardA->id);
    }

    public function testGetB()
    {
        $user = User::create(["name"=>"Tester","email"=>"tester@test.com","password"=>"tested"]);
        $cardA = Card::create(['heading'=>'test1', 'definition'=>'blabla2', 'owner_id'=>$user->id]);
        $cardB = Card::create(['heading'=>'test2', 'definition'=>'blabla2', 'owner_id'=>$user->id]);
        $link = new Link();
        $link->cardA = $cardA->id;
        $link->cardB = $cardB->id;
        $link->save();
        $this->assertEquals($link->getCardB()->id, $cardB->id);
    }
}
