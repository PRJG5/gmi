@extends('layouts.board')

@section('card-header')
    Fiches
@endsection
@section('body')
@if ($cards->isEmpty())
    <p>Pas de fiche</p>
@else
    @foreach ($cards as $card)
    <!-- ICI LISTE DES CARTES-->
        <div class="row">
            <div class="col-md-4">{{$card->heading}}</div>
            <form action='/card/{{$card->id}}' method="get">
                @csrf
                <button type="submit" class="btn btn-primary" style="padding-top=10px">Show</button>
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