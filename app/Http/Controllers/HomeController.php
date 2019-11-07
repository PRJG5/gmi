<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;

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

    public function getSearchView()
    {
        $cards = Card::all();
        return view('searchCard', ["cards" => $cards]);
    }

    public function searchCard(Request $request)
    {
        $search = $request->get('search');
        $cards = null;
        if ($search == "") {
            $cards = Card::all();
        } else {
            $cards = Card::where('heading', '=', $search)->get();
        }
        return view('searchCard', ['cards' => $cards]);
    }
}
