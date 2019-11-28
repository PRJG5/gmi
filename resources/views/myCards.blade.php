@extends('layouts.app')

@section('content')
<h1> Mes Fiches </h1>
@foreach ($cards as $card)
    @include('card.show')
@endforeach
@endsection
