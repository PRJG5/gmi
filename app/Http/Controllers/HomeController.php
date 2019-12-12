<?php

namespace App\Http\Controllers;

use App\Card;
use App\Language;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the search cards virw
     */
    public function getSearchView()
    {
        $cards = Card::orderBy('heading', 'ASC')->get();
        return view('searchCard', ["cards" => $cards]);
    }

    public function searchCard(Request $request)
    {
        $search = $request->get('search');
        $language = $request->get('languages');
        $cards = null;

        if ($search == "" && ($language == "All" || $language == "")) {
            $cards = Card::orderBy('heading', 'ASC')->get();
        } else if ($language == "All") {
            
            $cards = Card::where('heading', 'like', $search."%")
                    ->get()->sortByDesc('count_vote');

        } else if ($search == "") {
            $cards = Card::where('language_id', '=', $language)
                    ->orderBy('heading', 'ASC')
                    ->get();
        }else {
            $cards = Card::where('heading', 'like', $search."%")
                            ->where('language_id',  $language)
                            ->get()->sortByDesc('count_vote');
        }
    
        return view('searchCard', ['cards' => $cards, 'languages' => Language::orderBy('content')->get()]);
    }

    public function indexUsers(){
        return view('auth.administration.users')->with(['users'=> User::all()]);
    }

    //A placer dans auth
     public function modifyProfile(){
        $Alllanguages = Language::all();
        $user = User::find(Auth::user()->id);
        $languagesUser=$user->getLanguages();
         $languages = $Alllanguages->whereNotIn('id', $languagesUser->pluck('id'));
        
         
         return view('auth.modifyProfile',  compact('languages','languagesUser'));
     }
}
