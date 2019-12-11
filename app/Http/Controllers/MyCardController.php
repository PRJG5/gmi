<?php

namespace App\Http\Controllers;

use \Illuminate\Contracts\Support\Renderable;
use App\Card;
use Illuminate\Support\Facades\Auth;

class MyCardController extends Controller
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
     * @return Renderable
     */
    public function index()
    {
        $cards = Card::where('owner_id', Auth::user()->id)->where('delete','=','0')->get();
        return view('myCards', compact('cards'));
    }
}