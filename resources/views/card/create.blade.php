@extends('card.editable', [
	'card' => $card,
	'languages' => $languages,
	'action' => route('createCard'),
])
