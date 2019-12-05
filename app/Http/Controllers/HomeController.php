<?php

namespace App\Http\Controllers;

use App\Card;
use App\Language;
use Illuminate\Http\Request;
use App\User;

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
        $cards = Card::all();
        return view('searchCard', ["cards" => $cards]);
    }

    public function searchCard(Request $request)
    {
        $search = $request->get('search');
        $language = $request->get('languages');
        $cards = null;

        if ($search == "" && ($language == "All" || $language == "")) {
            $cards = Card::all();
        } else if ($language == "All") {
            
            $cards = Card::where('heading', 'like', $search."%")->get();

        } else if ($search == "") {
            $cards = Card::where('language_id', '=', $language)->get();
        }else {
            $cards = Card::where('heading', 'like', $search."%")->where('language_id',  $language)->get();
        }
    
        return view('searchCard', ['cards' => $cards, 'languages' => Language::all()]);
    }

    public function indexUsers(){
        return view('auth.administration.users')->with(['users'=> User::all()]);
    }
}
