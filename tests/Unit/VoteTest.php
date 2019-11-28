<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Vote;
use App\User;
use App\Card;

class VoteTest extends TestCase
{
    /**
     * Check if the vote is in the database.
     */
    public function testVoteInsert()
    {
        $vote = new Vote();
        $vote->user_id = 1;
        $vote->card_id = 7;
        $vote->save();
        $this->assertDatabaseHas('votes', [
            'user_id'=> $vote->user_id,
            'card_id'=> $vote->card_id
        ]);
        $vote->delete();
    }
    public function testVoteDelete(){
        $vote = new Vote();
        $vote->user_id = 2;
        $vote->card_id = 8;
        $vote->save();
        $idVote = $vote->id;
        $vote->delete();
        $this->assertDatabaseMissing('votes',['id'=>$idVote]);
        
    }

}
