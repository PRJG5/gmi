@extends('layouts.app')

@section('content')
<h1>Créer une carte</h1>

@include('card.edit', $card)
    
@endsection
