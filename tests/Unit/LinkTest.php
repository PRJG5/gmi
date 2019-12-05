<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Link;
use App\Card;
use App\User;
use App\Validation;
use Illuminate\Database\QueryException;

class LinkTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * Test a link with two cards ok
     */
    public function linkOkTest()
    {
        $validationA = Validation::create();
        $validationB = Validation::create();
        $user = User::create(["name"=>"Tester","email"=>"tester@test.com","password"=>"tested"]);
        $cardA = Card::create(['heading'=>'test1', 'definition'=>'blabla2', 'owner_id'=>$user->id,'validation_id'=>$validationA->id]);
        $cardB = Card::create(['heading'=>'test2', 'definition'=>'blabla2', 'owner_id'=>$user->id,'validation_id'=>$validationB->id]);
        $link = new Link();
        $link->cardA = $cardA->id;
        $link->cardB = $cardB->id;
        $link->save();
        $this->assertDatabaseHas('links', [
            'id'            => $link->id,
            'cardA'			=> $link->cardA,
            'cardB'		    => $link->cardB,
        ]);
    }

    /**
     * @test
     * Test with a link, where the first card is same of the second. Is error.
     */
    public function linkWithSameCardTest()
    {
        $validationA = Validation::create();
        $user = User::create(["name"=>"Tester","email"=>"tester@test.com","password"=>"tested"]);
        $cardA = Card::create(['heading'=>'test1', 'definition'=>'blabla2', 'owner_id'=>$user->id,'validation_id'=>$validationA->id]);
        $link = new Link();
        $this->expectException(QueryException::class);
        $link->cardA = $cardA->id;
        $link->cardB = $cardA->id;
        $link->save();
    }

    
    /**
     * @test
     * Test with two links, with the same cards
     */
    public function twoSameLinksNotOKTest()
    {
        $validationA = Validation::create();
        $validationB = Validation::create();
        $user = User::create(["name"=>"Tester","email"=>"tester@test.com","password"=>"tested"]);
        $cardA = Card::create(['heading'=>'test1', 'definition'=>'blabla2', 'owner_id'=>$user->id,'validation_id'=>$validationA->id]);
        $cardB = Card::create(['heading'=>'test2', 'definition'=>'blabla2', 'owner_id'=>$user->id,'validation_id'=>$validationB->id]);
        $link = new Link();
        $link->cardA = $cardA->id;
        $link->cardB = $cardA->id;
        $this->expectException(QueryException::class);
        $link->save();
        $link = new Link();
        $link->cardA = $cardA->id;
        $link->cardB = $cardA->id;
        $link->save();
    }

    
}
