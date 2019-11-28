@extends('layouts.app')

@section('content')
<h1>Toutes les fiches</h1>

@if ($cards->isEmpty())
    <p>Pas de fiche</p>
@else
    @include('card.index', $cards)
@endif
@endsection
