@extends('layouts.app')

@section('content')
<h1> Mes Fiches </h1>

@include('card.index', $cards)

@endsection

