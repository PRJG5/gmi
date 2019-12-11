@extends('layouts.card')
@extends('layouts.app')

@section('card-header')
@lang('cards.card') : {{$heading}}
@endsection
@section('card-body')

	<table class="table">
		<tbody>
			<tr>
				<th scope="row" class="text-center">@lang('cards.heading') :</th>
				<td class="text-left">{{$heading}}</td>
			</tr>
			
			@if(isset($phonetic))
				<tr>
					<th scope="row" class="text-center">@lang('cards.phonetic') :<br><a href="" target="_blank"><i class="fas fa-image pr-2"></i></a><a href="" target="_blank"><i class="fas fa-link pr-2"></i></a><a href="" target="_blank"><i class="fas fa-music pr-2"></i></a></th>
					<td class="text-left">{{$phonetic}}</td>
				</tr>
			@endif

			<tr>
				<th scope="row" class="text-center">@lang('cards.language') :</th>
				<td class="text-left">{{$languages}}</td>
			</tr>
			
			@if(isset($domain))
				<tr>
					<th scope="row" class="text-center">@lang('cards.domain') :</th>
					<td class="text-left">{{$domain}}</td>
				</tr>
			@endif
			
			@if(isset($subdomain))
				<tr>
					<th scope="row" class="text-center">@lang('cards.subdomain') :</th>
					<td class="text-left">{{$subdomain}}</td>
				</tr>
			@endif
			
			@if(isset($note))
				<tr>
					<th scope="row" class="text-center">@lang('cards.note') :<br><a href="" target="_blank"><i class="fas fa-image pr-2"></i></a><a href="" target="_blank"><i class="fas fa-link pr-2"></i></a><a href="" target="_blank"><i class="fas fa-music pr-2"></i></a></th>
					<td class="text-left">{{$note}}</td>
				</tr>
			@endif

			@if(isset($context))
				<tr>
					<th scope="row" class="text-center">@lang('cards.context') :<br><a href="" target="_blank"><i class="fas fa-image pr-2"></i></a><a href="" target="_blank"><i class="fas fa-link pr-2"></i></a><a href="" target="_blank"><i class="fas fa-music pr-2"></i></a></th>
					<td class="text-left">{{$context}}</td>
				</tr>
			@endif

			@if(isset($definition))
				<tr>
					<th scope="row" class="text-center">@lang('cards.definition') :</th>
					<td class="text-left">{{$definition}}</td>
				</tr>
			@endif
			
			@if(isset($vote_count))
				<tr>
					<th scope="row" class="text-center">@lang('cards.voteCount') :</th>
					<td class="text-left">{{$vote_count}}</td>
				</tr>
			@endif

		</tbody>
	</table>

	<hr>

	<section>

		<h4>Basic Actions</h4>
		
		@if(Auth::user()->id != $card->owner_id)
			<a href="/cards/vote/{{$card->id}}" class="btn btn-primary">@lang('cards.voteForCard')</a>
		@endif

		<a href="/cards/{{$card_id}}/linkList" class="btn btn-primary">@lang('cards.seeLinkedCards')</a>

		<a href="/cards/{{$card_id}}/link" class="btn btn-primary">@lang('cards.linkCard')</a>
	</section>

	@if(in_array($card->language_id, Auth::user()->getLanguagesKeyArray()))

		<hr>
	
		<section>

			<h4>Danger Zone</h4>

			@if(!isset($card->validation_id))
				<a href="/cards/{{$card->id}}/edit" class="btn btn-primary">@lang('cards.editCard')</a>
			@endif
			
			@if(Auth::user()->role == \App\Enums\Roles::ADMIN && isset($card->validation_id))
				<form action="{{ route('cards.removeValidation', $card) }}" method="POST" style="margin: 0; width: fit-content; display: inline-block;">

					@csrf

					<button class="btn btn-warning">Remove validation</button>
				</form>
			@endif

			@if(Auth::user()->role != \App\Enums\Roles::USERS)
				<form action="{{ route('cards.destroy', $card_id) }}" method="POST" style="margin: 0; width: fit-content; display: inline-block;">

					@csrf

					@method('DELETE')

					<button class="btn btn-danger">@lang('cards.deleteCard')</button>
				</form>
			@endif

		</section>
	@endif

@endsection
