@extends('card.editable', [
	'action' => '/cards',
	'card' => null,
	'languages' => $languages,
	'user' => null,
])

@section('card_id')
@endsection

@section('owner_id')
@endsection

@foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach
