<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Vote;

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
            //'id' => $vote->id,
            'user_id'=> $vote->user_id,
            'card_id'=> $vote->card_id
        ]);
        $vote->delete();
    }

}
