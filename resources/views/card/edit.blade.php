@extends('card.editable', [
	'action' => "/cards/{$card->id}",
	'card' => $card,
	'languages' => $languages,
	'owner' => $owner,
])

@section('patch')
@method('PATCH')
@endsection
