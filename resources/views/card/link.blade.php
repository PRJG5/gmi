@extends('layouts.card')
@extends ('layouts.app')
@section('card-header')
	@lang('cards.cardToLink')
@endsection

@section('card-body')
	<table class="table">
		<tbody>
			<tr>
				<th scope="row" class="text-center">@lang('cards.heading') :</th>
				<td class="text-left">{{$cardOrigin->getHeading()}}</td>
			</tr>

			@if(isset($cardOrigin->phonetic))
				<tr>
					<th scope="row" class="text-center">@lang('cards.phonetic') :</th>
					<td class="text-left">{{$cardOrigin->getPhonetic()}}</td>
				</tr>
			@endif

			<tr>
				<th scope="row" class="text-center">@lang('cards.language') :</th>
				<td class="text-left">{{$cardOrigin->getLanguage()}}</td>
			</tr>


			@if(isset($cardOrigin->domain_id))
				<tr>
					<th scope="row" class="text-center">@lang('cards.domain') :</th>
					<td class="text-left">{{$cardOrigin->getDomain()}}</td>
				</tr>
			@endif

			@if(isset($cardOrigin->subdomain_id))
				<tr>
					<th scope="row" class="text-center">@lang('cards.subdomain') :</th>
					<td class="text-left">{{$cardOrigin->getSubdomain()}}</td>
				</tr>
			@endif

			@if(isset($cardOrigin->note_id))
				<tr>
					<th scope="row" class="text-center">@lang('cards.note') :</th>
					<td class="text-left">{{$cardOrigin->getNote()}}</td>
				</tr>
			@endif

			@if(isset($cardOrigin->context_id))
				<tr>
					<th scope="row" class="text-center">@lang('cards.context') :</th>
					<td class="text-left">{{$cardOrigin->getContext()}}</td>
				</tr>
			@endif

			@if(isset($cardOrigin->definition_id))
				<tr>
					<th scope="row" class="text-center">@lang('cards.definition') :</th>
					<td class="text-left">{{$cardOrigin->getDefinition()}}</td>
				</tr>
			@endif

			{{--
			@if(isset($vote_count))
				<tr>
					<th scope="row" class="text-center">@lang('cards.voteCount') :</th>
					<td class="text-left">{{$cardOrigin->getvote_count}}</td>
				</tr>
			@endif
			--}}

			
				<tr>
					<form action="{{route('createAndLink',$cardOrigin->id)}}">
						@csrf
						<button type ='submit' class="btn btn-primary"> @lang('cards.linkAndCreate')</button>
					</form>
				</tr>
			

		</tbody>
	</table>
@endsection

@section("under-card")
	<div class="container p-4">
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">

			<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" style="margin-top:20em">
				<span class="carousel-control-prev-icon" aria-hidden="true" style="background-color:black;"></span>
				<span class="sr-only">@lang('pagination.previous')</span>
			</a>

			<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" style="margin-top:20em; ">
				<span class="carousel-control-next-icon" style="background-color:black;"></span>
				<span class="sr-only" style="color:black;">@lang('pagination.next')</span>
			</a>

			@foreach ($cardLinked as $card)

				@if($loop->first)
				<div class="carousel-item active">
					@else
					<div class="carousel-item">
						@endif

						<div class="row justify-content-center" style="margin-bottom:1.5em;">
							<div class="col-md-8">
								<div class="card">
									<div class="card-header blue white-text text-center">Carte à lier :{{$card->getHeading()}} </div>
									<div class="card-body">
										<table class="table">
											<tbody>
												<tr>
													<th scope="row" class="text-center">Vedette :</th>
													<td class="text-left">{{$card->getHeading()}}</td>
												</tr>
												<tr>
													<th scope="row" class="text-center">Langue :</th>
													<td class="text-left">{{$card->getLanguage()}}</td>
												</tr>

												@if(isset($card->phonetic))
												<tr>

													<th scope="row" class="text-center">Phonétique :</th>
													<td class="text-left">{{$cardOrigin->getPhonetic()}}</td>
												</tr>
												@endif
												@if(isset($cardOrigin->domain_id))
												<tr>

													<th scope="row" class="text-center">Domaine :</th>
													<td class="text-left">{{$card->getDomain()}}</td>
												</tr>
												@endif
												@if(isset($card->subdomain_id))
												<tr>

													<th scope="row" class="text-center">Sous domaine :</th>
													<td class="text-left">{{$card->getSubdomain()}}</td>
												</tr>
												@endif
												@if(isset($card->context_id))
												<tr>

													<th scope="row" class="text-center">Contexte :</th>
													<td class="text-left">{{$card->getContext()}}</td>
												</tr>
												@endif
												@if(isset($card->note_id))
												<tr>

													<th scope="row" class="text-center">Note :</th>
													<td class="text-left">{{$card->getNote()}}</td>
												</tr>
												@endif

												{{--
												@if(isset($vote_count))
													<tr>
														<th scope="row" class="text-center">Nombre de vote :</th>
														<td class="text-left">{{$cardOrigin->getvote_count}}</td>
													</tr>
												@endif
												--}}

											</tbody>
										</table>
										{{--
										<div class="block center">
											<label class="col-md-6 col-form-label text-md-right"> Vedette:</label>
											<label>{{$card->getHeading()}}</label>

											<label class="col-md-6 col-form-label text-md-right"> Langue :</label>
											<label>{{$card->getLanguage()}}</label>

											@if (isset($card->phonetic))
												<label class="col-md-6 col-form-label text-md-right"> Phonetique :</label>
												<label>{{$card->getPhonetic()}}</label>
											@endif

											@if (isset($card->domain_id))
												<label class="col-md-6 col-form-label text-md-right"> Domaine :</label>
												<label>{{$card->getDomain()}}</label>
											@endif

											@if (isset($card->subdomain_id))
												<label class="col-md-6 col-form-label text-md-right"> Sous-Domaine :</label>
												<label>{{$card->getSubdomain()}}</label>
											@endif

											@if (isset($card->definition_id))
												<label class="col-md-6 col-form-label text-md-right"> Definition :</label>
												<label>{{$card->getDefinition()}}</label>
											@endif

											@if (isset($card->context_id))
												<label class="col-md-6 col-form-label text-md-right"> Contexte :</label>
												<label>{{$card->getContext()}}</label>
											@endif

											@if (isset($card->note_id))
												<label class="col-md-6 col-form-label text-md-right"> Note :</label>
												<label>{{$card->getNote()}}</label>
											@endif

											<label class="col-md-6 col-form-label text-md-right"> Nombre de vote :</label>
											<label>{{$card->getCountVoteAttribute()}}</label>
										</div>
										--}}
									</div>
									<div style="display:flex;justify-content:space-evenly;">
										<form action="{{route('linktoanother',['cardOrigin'=>$cardOrigin->id,'card'=>$card->id])}}" method="get">
											@csrf
											<input value="{{$card->id}}" type="hidden" name="card">
											<input value="{{$cardOrigin->id}}" type="hidden" name="cardOrigin">
											<button type="submit" class="btn btn-primary" style="margin-bottom:1.2em">Link</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>

				@endforeach


			</div>

		</div>

@endsection

@include("layouts.error")
@include("layouts.success")
