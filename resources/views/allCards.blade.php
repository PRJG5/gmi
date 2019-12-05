@extends('layouts.app')

@section('content')
<h1>Toutes les fiches</h1>

@include('card.index', $cards)

@endsection
