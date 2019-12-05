<?php

namespace App\Http\Controllers;

use App\User;
use App\Card;
use App\Vote;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function voteCard($card_id){
        $vote = new Vote();
        $vote->user_id= Auth::user()->id;
        $vote->card_id=$card_id;
        if(!(Vote::where('user_id','=',$vote->user_id, 'AND','card_id','=',$vote->card_id)->exists())){
            $vote->save();
        }
        return redirect()->action('CardController@show', [$card_id]);
    }
}