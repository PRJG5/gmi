<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Vote;
use App\User;
use App\Card;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VoteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Check if the vote is in the database.
     */
    public function testVoteInsert()
    {
        $user = new User([
            'name' => 'user',
            'email' => 'ftyhyjyttjt@example.com',
            'password' => 'password']);
        $user->save();
        $card = new Card([
            'heading' => 'hello',
            'phoenetic_id' => NULL,
            'domain_id' => 'Legal',
            'subdomain_id' => 'Justice',
            'definition_id' => NULL,
            'context_id' => NULL,
            'note_id' => NULL,
            'language_id' => 'ARA',
            "owner_id" => $user->id]);
        $card->save();
        $vote = new Vote();
        $vote->user_id = $user->id;
        $vote->card_id = $card->id;
        $vote->save();
        $this->assertDatabaseHas('votes', [
            'user_id'=> $vote->user_id,
            'card_id'=> $vote->card_id
        ]);
    }
    public function testVoteDelete(){
        $user = new User([
            'name' => 'user',
            'email' => 'ftyhyjyttjt@example.com',
            'password' => 'password']);
        $user->save();
        $card = new Card([
            'heading' => 'hello',
            'phoenetic_id' => NULL,
            'domain_id' => 'Legal',
            'subdomain_id' => 'Justice',
            'definition_id' => NULL,
            'context_id' => NULL,
            'note_id' => NULL,
            'language_id' => 'ARA',
            "owner_id" => $user->id]);
        $card->save();
        $vote = new Vote();
        $vote->user_id = $user->id;
        $vote->card_id = $card->id;
        $vote->save();
        $idVote = $vote->id;
        $vote->delete();
        $this->assertDatabaseMissing('votes',['id'=>$idVote]);
        
    }

}