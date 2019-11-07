@extends('card.editable', [
	'action' => "/cards/{$card->card_id}",
	'card' => $card,
	'languages' => $languages,
	'user' => $user,
])

@section('patch')
@method('PATCH')
@endsection
