@extends('layouts.app')

@section('content')
<h1> Mes Fiches </h1>

@if ($cards->isEmpty())
    <p>Pas de fiche</p>
@else
    @include('card.index', $cards)
@endif
@endsection
