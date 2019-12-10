@extends('layouts.card' )

@section('card-body')
	<table class="table">
		<tbody>
			<tr>
				<th scope="row" class="text-center">@lang('cards.heading') :</th>
				<td class="text-left">{{$heading}}</td>
			</tr>
			
			@if(isset($phonetic))
				<tr>
					<th scope="row" class="text-center">@lang('cards.phonetic') :</th>
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
					<th scope="row" class="text-center">@lang('cards.note') :</th>
					<td class="text-left">{{$note}}</td>
				</tr>
			@endif

			@if(isset($context))
				<tr>
					<th scope="row" class="text-center">@lang('cards.context') :</th>
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
	@yield('card-button')   
@endsection
