<?php

namespace Tests\Unit;

use App\Context;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContextTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testValidInsertion()
    {
        $context = "Hello I love You won't you tell me your name?";
      	// $con = factory(App\Context::class)->make();
        $con = new Context();
        $con->context_to_string = $context;
        $con->save();
        $this->assertDatabaseHas('contexts', [
			'id' => $con->id,
			'context_to_string'=> $context,
		]);
        $con->delete();
    }

    /**
     * Test if an exception is thrown when we try to insert a context
     * with null context_to_string.
     */
    public function testInsertNullDescription(){
        $this->expectException(QueryException::class);
        $con = new Context();
        $con->save();
    }

    /**
     * Test if a deleted context is no more into the database.
     */
    public function testIfDeleted(){
        $context = "Whole Lotta Love";
        $con = new Context();
        $con->context_to_string = $context;
        $con->save();
        $idCon = $con->id;
        $con->delete();
        $this->assertDatabaseMissing('contexts', [
			'id' =>$idCon,
		]);
    }

    /**
     * Test if the toString method returns a valid toString.
     */
    public function testToString(){
        $con =new Context();
        $context = "Heaven Gate";
        $con->context_to_string = $context;
        $con->save();
        $str = $con->__toString();
        $this->assertTrue($str == $con->id . " " . $context);
        $con->delete();
    }



}
