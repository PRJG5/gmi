@extends('layouts.card')

@section('card-header')
@lang('search.searchCard')
@endsection

@section('card-body')
<div class="form-group">
	<label for="heading">@lang('card.heading') :</label>
	<input name="heading" class="form-control" placeholder="@lang('card.heading')"/>
</div>
<div class="form-group">
	<label for="language">@lang('card.language') :</label>
	<select name="language" class="form-control" placeholder="@lang('card.heading') :">
		<option>Any</option>
		@foreach($languages as $language)
			<option value="{{ $language }}">{{ $language }}</option>
		@endforeach
	</select>
</div>
<button type="submit" class="btn btn-primary" onclick="searchCards()">@lang('search.search')</button>

<div id="results">

</div>
<script>
function searchCards() {

}
</script>
@endsection
