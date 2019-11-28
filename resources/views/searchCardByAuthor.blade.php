{{-- 
	View to display all cards from an user.
	The cards are found with the user id.
	XMLHTTPRequest are used
--}}
@extends('layouts.card')

@section('card-header')
@lang('card.searchCardByAuthor')
@endsection
@section('card-body')
<div class="form-group">
	<label for="nameAuthor">@lang('card.searchCardByAuthor')</label>
	<select id="authors" class="form-control" name="author" required>
		@foreach ($authors as $author)
			<option value="{{ $author->id }}">{{$author->name }} ({{$author->email }})</option>
		@endforeach
	</select>
</div>
<button type="submit" class="btn btn-primary" onclick="searchCards()">@lang('misc.search')</button>
<div id="listOfCards">
	{{-- TODO: Need to extend the layout --}}
</div>

<script>
/** 
* Gets the cards of the user id.
* Updates the view with the card template
*/
function searchCards() {
	const author = $('#authors').find(":selected").val();
	xhr("GET", `{{ route('getAllCardsFromUser', '') }}/${author}`)
	.then((results) => {
		$("#listOfCards").empty(); //Clears container to add the new cards
		results = JSON.parse(results);
		if(results.length > 0) {
			results.forEach((card) => {
				console.log(card);
				xhr("GET", `{{ route('cards.show', '') }}/${card.id}`)
				.then((cardResult) => {
					$("#listOfCards").append(cardResult);
				});
			});
		} else {
			$("#listOfCards").append("@lang('misc.noResults')");
		}
		
	})
	.catch((error) => {
		console.error(`Error happened during xhr.\n${error.status} - ${error.statusText}`);
	});
}
</script>
@endsection
