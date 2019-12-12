@extends('layouts.card')
@extends('layouts.app')

@section('card-header')
@lang('cards.card') : {{$card->heading}}
@endsection
@section('card-body')

	<table class="table">
		<tbody>
			{{-- HEADING + HEADING URL --}}
			<tr>
				<th scope="row" class="text-center">@lang('cards.heading') :</th>
				<td class="text-left">
					@if ($card->language->isSigned && isset($card->headingURL))
						<a href="{{$card->headingURL}}" target="_blank">{{$card->heading}}</a>
					@else
						{{$card->heading}}
					@endif
				</td>
			</tr>
			
			{{-- PHONETIC --}}
			@if(isset($card->phonetic) && (!$card->language->isSigned))
				<tr>
					<th scope="row" class="text-center">@lang('cards.phonetic') :<br>
						@if(isset($card->phonetic->image))<a href="{{$card->phonetic->image}}" target="_blank"><i class="fas fa-image pr-2"></i></a>@endif
						@if(isset($card->phonetic->url))<a href="{{$card->phonetic->url}}" target="_blank"><i class="fas fa-link pr-2"></i></a>@endif
						@if(isset($card->phonetic->son))<a href="{{$card->phonetic->son}}" target="_blank"><i class="fas fa-music pr-2"></i></a>@endif
					</th>
					<td class="text-left">{{$card->phonetic->textDescription}}</td>
				</tr>
			@endif

			{{-- LANGUAGE --}}
			<tr>
				<th scope="row" class="text-center">@lang('cards.language') :</th>
				<td class="text-left">{{$card->language->content}}</td>
			</tr>

			{{-- DOMAIN --}}
			@if(isset($card->domain))
				<tr>
					<th scope="row" class="text-center">@lang('cards.domain') :</th>
					<td class="text-left">{{$card->domain->content}}</td>
				</tr>
			@endif

			{{-- SUBDOMAIN --}}
			@if(isset($card->subdomain))
				<tr>
					<th scope="row" class="text-center">@lang('cards.subdomain') :</th>
					<td class="text-left">{{$card->subdomain->content}}</td>
				</tr>
			@endif

			{{-- CONTEXT --}}
			@if(isset($card->context))
				<tr>
					<th scope="row" class="text-center">@lang('cards.context') :
						<br>
						@if(isset($card->context->image))<a href="{{$card->context->image}}" target="_blank"><i class="fas fa-image pr-2"></i></a>@endif
						@if(isset($card->context->url))<a href="{{$card->context->url}}" target="_blank"><i class="fas fa-link pr-2"></i></a>@endif
						@if(isset($card->context->son))<a href="{{$card->context->son}}" target="_blank"><i class="fas fa-music pr-2"></i></a>@endif
					</th>
					<td class="text-left">
						@if ($card->language->isSigned)
							<a href="{{$card->context->context_to_string}}" target="_blank">@lang('cards.video')</a>
						@else
							<label>{{$card->context->context_to_string}}</label>
						@endif
					</td>
				</tr>
			@endif

			{{-- DEFINITION --}}
			@if(isset($card->definition))
				<tr>
					<th scope="row" class="text-center">@lang('cards.definition') :</th>
					<td class="text-left">
						@if ($card->language->isSigned)
							<a href="{{$card->definition->definition_content}}" target="_blank">@lang('cards.video')</a>
						@else
							<label>{{$card->definition->definition_content}}</label>
						@endif
					</td>
				</tr>
			@endif

			{{-- NOTE --}}
			@if(isset($card->note))
				<tr>
					<th scope="row" class="text-center">@lang('cards.note') :<br>
						@if(isset($card->note->image))<a href="{{$card->note->image}}" target="_blank"><i class="fas fa-image pr-2"></i></a>@endif
						@if(isset($card->note->url))<a href="{{$card->note->url}}" target="_blank"><i class="fas fa-link pr-2"></i></a>@endif
						@if(isset($card->note->son))<a href="{{$card->note->son}}" target="_blank"><i class="fas fa-music pr-2"></i></a>@endif
					</th>
					<td class="text-left">
						@if ($card->language->isSigned)
							<a href="{{$card->note->description}}" target="_blank">@lang('cards.video')</a>
						@else
							{{$card->note->description}}
						@endif
					</td>
				</tr>
			@endif

			{{-- NB VOTE --}}
			<tr>
				<th scope="row" class="text-center">@lang('cards.voteCount') :</th>
				<td class="text-left">{{$card->getCountVoteAttribute()}}</td>
			</tr>

		</tbody>
	</table>

	<hr>

	<section>

		<h4>@lang('cards.basicActions')</h4>

		@if(Auth::user()->id != $card->owner_id && !$hasVote && in_array($card->language_id, Auth::user()->getLanguagesKeyArray()))
			<a href="/cards/vote/{{$card->id}}" class="btn btn-primary">@lang('cards.voteForCard')</a>
		@endif

		<a href="/cards/{{$card->id}}/linkList" class="btn btn-primary">@lang('cards.seeLinkedCards')</a>

		<a href="/cards/{{$card->id}}/link" class="btn btn-primary">@lang('cards.linkCard')</a>
	</section>

	@if(in_array($card->language_id, Auth::user()->getLanguagesKeyArray()))

		<hr>

		<section>

			<h4>@lang('cards.dangerZone')</h4>

			@if(!isset($card->validation_id))
				<a href="/cards/{{$card->id}}/edit" class="btn btn-primary">@lang('cards.editCard')</a>
			@endif

			@if(Auth::user()->role == \App\Enums\Roles::ADMIN && isset($card->validation_id))
				<form action="{{ route('cards.removeValidation', $card) }}" method="POST" style="margin: 0; width: fit-content; display: inline-block;">

					@csrf

					<button class="btn btn-warning">@lang('cards.removeValidation')</button>
				</form>
			@endif

			@if(Auth::user()->role != \App\Enums\Roles::USERS)
				<form action="{{ route('cards.destroy', $card->id) }}" method="POST" style="margin: 0; width: fit-content; display: inline-block;">

					@csrf

					@method('DELETE')

					<button class="btn btn-danger">@lang('cards.deleteCard')</button>
				</form>
			@endif

		</section>
	@endif

@endsection

@include('layouts.success')