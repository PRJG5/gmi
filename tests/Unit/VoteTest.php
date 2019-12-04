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
		$user = new User([
			'name'		=> 'Test',
			'email'		=> 'tttttesttttt@test.com',
			'password'	=> 'test',
		]);
		$user->save();
		$card = new Card([
			'heading' => 'hello',
			'phonetic_id' => NULL,
			'domain_id' => 'Legal',
			'subdomain_id' => 'Justice',
			'definition_id' => NULL,
			'context_id' => NULL,
			'note_id' => NULL,
			'language_id' => 'ARA',
			'owner_id' => $user->id,
		]);
		$card->save();
        $vote = new Vote([
        	'user_id' => $user->id,
			'card_id' => $card->id,
		]);
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
        $this->assertDatabaseMissing('votes', ['id' => $idVote]);
        
    }

}
