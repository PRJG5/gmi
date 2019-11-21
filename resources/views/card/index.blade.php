@extends('layouts.board')

@section('card-header')
    Cards
@endsection
@section('body')
@foreach ($cards as $card)
<!-- ICI LISTE DES CARTES-->
    <div class="row">
        <div class="col-md-4">{{$card->heading}}</div>
        <form action='/cards/{{$card->id}}' method="get">
            @csrf
            <button type="submit" class="btn btn-primary">Show</button>
        </form>
    </div>
@endforeach
    <div class="row">
        <form action={{route('cards.create')}} method="get">
            @csrf
            <button type="submit" class="btn btn-primary">add Card</button>
        </form>
    </div>
@endsection