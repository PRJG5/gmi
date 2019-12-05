@extends('layouts.app')

@section('content')
<h1>Une carte</h1>

@include('card.show', $card)
    
@endsection
