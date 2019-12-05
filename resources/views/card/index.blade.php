@extends('layouts.board')

@section('card-header')
    Fiches
@endsection
@section('body')
@if ($cards->isEmpty())
    <p>Pas de fiche</p>
@else
        <div class="row">
            <div class="col-md-4"> <b> Vedette </b></div>
            <div class="col-md-4"> <b> Votes </b></div>
        </div>
        </br>
    @foreach ($cards as $card)
    <!-- ICI LISTE DES CARTES-->
        <div class="row">
            <div class="col-md-4">{{$card->heading}}</div>
            <div class="col-md-4">{{$card->nbVotes}}</div>

            <form action='/card/{{$card->id}}' method="get">
                @csrf
                <button type="submit" class="btn btn-primary">Show</button>
            </form>
        </div>
    @endforeach
@endif

<div class="row">
    <form action={{route('cards.create')}} method="get">
        @csrf
        <button type="submit" class="btn btn-primary">add Card</button>
    </form>
</div>
    
@endsection