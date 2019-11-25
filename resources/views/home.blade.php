@extends('layouts.card')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ config('app.name') }}</div>
				<div class="card-body">
				<div class="links">
					<a href="{{ route('cards.index') }}">@lang('card.allCards')</a>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
