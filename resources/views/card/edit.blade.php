@extends('card.editable', [
	'card' => $card,
	'languages' => $languages,
	'action' => "/cards/{$card->card_id}",
])

@section('patch')
@method('PATCH')
@endsection
