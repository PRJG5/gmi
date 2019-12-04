@extends('layouts.card')

@section('card-header')
@lang('search.searchCardByAuthor')
@endsection
@section('card-body')
<div class="form-group">
	<label for="nameAuthor">@lang('search.searchCardByAuthor')</label>
	<select id="authors" class="form-control" name="author" required>
		@foreach ($authors as $author)
			<option value="{{ $author->id }}">{{$author->name }} ({{$author->email }})</option>
		@endforeach
	</select>
</div>
<button type="submit" class="btn btn-primary" onclick="searchCards()">@lang('search.search')</button>
<div id="listOfCards">
</div>

<script>
/** 
* Gets the cards of the user id.
* Updates the view with the card template
*/
function searchCards() {
	const author = $('#authors').find(":selected").val();
	xhr("GET", `{{ route('getAllCardsFromUser', '') }}/${author}`)
	.then((result) => {
		$("#listOfCards").empty(); //Clears container to add the new cards
		$("#listOfCards").append(result);
	})
	.catch((error) => {
		console.error(`Error happened during xhr.\n${error.status} - ${error.statusText}`);
	});
}
</script>
@endsection
