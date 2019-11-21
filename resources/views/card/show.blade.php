<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width">
		<meta name="description" content="Card">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}" >
		<link rel="stylesheet" type="text/css" href="{{ asset('css/themes/default/common.css') }}" >
		<title>Card {{ isset($card) ? strval($card->cardId) : '' }}</title>
		
	<div class="cardBody">

		@section('error_owner_id')
			@show

			@section('owner')
			<label for="owner">Owner:</label>
			<input name="owner" value="{{ isset($owner) ? $owner->name : '' }}" disabled />
		@show

		{{--
		definition
		--}}



		@section('edit')
		<a href="{{ isset($card) ? $card->card_id : '' }}/edit" class="buttonLike"	title="Edit">Edit</a>
		@show
		
		@section('delete')
		<form action="/cards/{{ isset($card) ? $card->card_id : '' }}" method="post">
			@method('DELETE')
			@csrf
			<input type="submit" class="buttonLike" value="Delete"	title="Delete" />
		</form>
		@show
	</body>
</html>
