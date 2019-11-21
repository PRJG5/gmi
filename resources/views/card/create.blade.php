@extends('card.editable', [
	'action' => '/cards',
	'card' => null,
	'languages' => $languages,
	'owner' => null,
])

@section('card_id')
@endsection

@section('owner_id')
@endsection

@foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach
