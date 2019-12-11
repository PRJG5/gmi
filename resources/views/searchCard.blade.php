@extends('layouts.app')

@section('content')

	<h1>@lang('cards.searchCardByHeadingOrLanguage')</h1>

	<form class="form-inline" action="/searchCard" method="get">

		<div class="input-group mr-sm-2 w-50">
			<input name="search" type="search" class="form-control" placeholder="@lang('cards.heading')"/>
		</div>

		<div class="input-group mr-sm-2 w-25">
			<select name="languages" class="form-control">
				<option>All</option>
				@foreach($languages as $language)
					<option value="{{$language->slug}}">{{$language->content}}</option>
				@endforeach
			</select>
		</div>
		<div class="input-group w-20">
			<button type="submit" class="btn btn-primary">Search</button>
		</div>
	</form>

	@include('card.index')

@endsection
