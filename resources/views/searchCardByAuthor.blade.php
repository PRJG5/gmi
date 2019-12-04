@extends('layouts.container')

@section('container-title')
	@lang('search.searchCardByAuthor')
@endsection

@section('container-body')
	<div class="form-group">
		<label for="nameAuthor">@lang('search.searchCardByAuthor')
			<select id="authors" class="form-control" name="author" required>
				@foreach ($authors as $author)
					<option value="{{ $author->id }}">{{$author->name }} ({{$author->email }})</option>
				@endforeach
			</select>
		</label>
	</div>
	<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
			aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="errorModalLabel">@lang('misc.error')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger" role="alert">@lang('misc.error')</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-primary" onclick="searchCards()">@lang('search.search')</button>
	<div id="listOfCards" style="padding-top:20px;"></div>

	<script>
        /**
         * Gets the cards of the user id.
         * Updates the view with the card template
         */
        function searchCards() {
            const author = $('#authors').find(":selected").val();
            xhr("GET", `{{ route('getAllCardsFromUser', '') }}/${author}`)
                .then((result) => {
                    $("#listOfCards").empty();
                    $("#listOfCards").append(result.responseText);
                })
                .catch((error) => {
                    $("#errorModal").modal('show');
                });
        }
	</script>
@endsection
