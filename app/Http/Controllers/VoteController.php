<?php

namespace App\Http\Controllers;

use App\User;
use App\Card;
use App\Vote;
use Illuminate\Support\Facades\Auth;

/**
 * @author 45324 Kaplan Oruc
 */
class VoteController extends Controller
{
    public function voteCard($card_id){
        $vote = new Vote();
        $vote->user_id= Auth::user()->id;
        $vote->card_id=$card_id;
        if(Vote::where([['user_id','=',$vote->user_id], ['card_id','=',$vote->card_id]])->doesntExist()){ /* verif if the vote not exist */
            $vote->save();
        }
        #return redirect()->action('CardController@show', [Card::find($card_id)]);
        return redirect()->back();
    }
}