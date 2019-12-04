@extends('layouts.container')

@section('container-title')
	@lang('search.searchCard')
@endsection

@section('container-body')
	<div class="form-group">
		<label for="heading">@lang('card.heading') :
			<input id="heading" name="heading" class="form-control" placeholder="@lang('card.heading')"/>
		</label>
	</div>
	<div class="form-group">
		<label for="language">@lang('card.language') :
			<select id="lang" name="language" class="form-control">
				<option value="*">Any</option>
				@foreach($languages as $language)
					<option value="{{ $language->slug }}">{{ $language->content }}</option>
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
	<div id="results" style="padding-top:20px;"></div>

	<script>
        function searchCards() {
			const heading = $("#heading").val() || "";
			const lang = $("#lang").val() || "";
			xhr("GET", `{{route('getAllCardsInLangOrWithHeading')}}?heading=${heading}&lang=${lang}`, {}, {
				"search": heading,
				"languages": lang,
			})
			.then((result) => {
				$("#results").empty();
				$("#results").append(result.responseText);
			})
			.catch((error) => {
				$("#errorModal").modal('show');
			});
        }
	</script>
@endsection
