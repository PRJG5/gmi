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
        $card = Card::where('id', $card_id)->first();
        $languages = Auth::user()->getLanguagesKeyArray();
        if(Vote::where([['user_id','=',$vote->user_id], ['card_id','=',$vote->card_id]])->doesntExist()
            && $card->owner_id != Auth::user()->id 
            && in_array($card->language_id, Auth::user()->getLanguagesKeyArray())){ /* verif if the vote not exist */
            $vote->save();
            // Execute the validation methode after each vote
            Card::where('id','=',$card_id)->first()->validate();
        }
        #return redirect()->action('CardController@show', [Card::find($card_id)]);
        return redirect()->back();
    }
}