<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Note;

class NoteTest extends TestCase
{
    /**
     * Check if the description is null in the database.
     */
    public function testRegisterNullDescription()
    {
        $note = new Note();
        $note->save();
        $this->assertDatabaseHas('notes', ['id'=>$note->id,'description'=>null]);
        $note->delete();
    }

    /**
     * Check if the description is not null in the database.
     */
    public function testRegistrerWithDescription()
    {
        $note = new Note();
        $note->description= "Test";
        $note->save();
        $this->assertDatabaseHas('notes', ['id'=>$note->id,'description'=>"Test"]);
        $note->delete();
    }

    /**
     * Check if the note was deleted.
     */
    public function testIfDeleted()
    {
        $note = new Note();
        $note->save();
        $idNote = $note->id;
        $note->delete();
        $this->assertDatabaseMissing('notes',['id'=>$idNote]);
    }

    /**
     * Check if the to string is the concatenation of the id and the description.
     */
    public function testToString() {
        $note = new Note();
        $note->description= "Test to string";
        $note->save();
        $str = $note->__toString();
        $this->assertTrue($str == $note->id . "Test to string");
        $note->delete();
    }
}
