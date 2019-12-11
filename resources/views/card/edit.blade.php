@extends('layouts.card')
@extends('layouts.app')

@section('content')

	@section('card-header')
		@lang('cards.editCard')
	@endsection

	@section('card-body')
		<form action="{{route('cards.update', $card)}}" method="POST">

			@method('PUT')

			@csrf
	   
			{{-- HEADING --}}
			<div class="form-group row">
				<label for="heading" class="col-md-6 col-form-label text-md-right">@lang('cards.heading') :</label>
				<input type="text" name="heading" id="heading" placeholder="@lang('cards.heading')" title="@lang('cards.heading')" value="{{$card->heading}}" readonly>
			</div>
			{{-- HEADING URL --}}
			@if ($card->language->isSigned)
				<div class="form-group row">
					<label for="headingURL" class="col-md-6 col-form-label text-md-right">@lang('cards.headingURL') :</label>
					<input type="text" name="headingURL" id="headingURL" value="{{$card->headingURL}}" title="@lang('cards.headingURL')" placeholder="www.example.com">
				</div>
			@endif
			
			{{-- PHONETIC --}}
			@if (!$card->language->isSigned)
				<div class="form-group row">
					<label for="phonetic" class="col-md-6 col-form-label text-md-right">@lang('cards.phonetic') :</label>
					<input name="phonetic" class="phonetic" type="text" placeholder="@lang('cards.phonetic')" value="{{isset($card->phonetic) ? $card->phonetic->textDescription : ''}}" title="@lang('cards.phonetic')"/>
					<!-- Classic tabs -->
						<div class="classic-tabs mx-2" id="phoneticDiv" style="width:100%;">
							<ul class="nav tabs-orange" id="myClassicTabOrange" role="tablist">
								<li class="nav-item">
									<a class="nav-link  waves-light active show" id="profile-tab-classic-orange" data-toggle="tab" href="#phonetic_img"
									   role="tab" aria-controls="profile-classic-orange" aria-selected="true"><i class="fas fa-image"
																												 aria-hidden="true"></i></a>
								</li>
								<li class="nav-item">
									<a class="nav-link waves-light" id="follow-tab-classic-orange" data-toggle="tab" href="#phonetic_link"
									   role="tab" aria-controls="follow-classic-orange" aria-selected="false"><i class="fas fa-link"
																												 aria-hidden="true"></i></a>
								</li>
								<li class="nav-item">
									<a class="nav-link waves-light" id="contact-tab-classic-orange" data-toggle="tab" href="#phonetic_music"
									   role="tab" aria-controls="contact-classic-orange" aria-selected="false"><i class="fas fa-music"
																												  aria-hidden="true"></i></a>
								</li>
							</ul>

							<div class="tab-content card" id="myClassicTabContentOrange">
								<div class="tab-pane fade active show" id="phonetic_img" role="tabpanel" aria-labelledby="profile-tab-classic-orange">
									<label for="phonetic_img" class="col-md-6 col-form-label text-md-right">@lang('cards.phonetic_img') :</label>
									<input name="phonetic_img" type="url" placeholder="www.example.com" title="@lang('cards.phonetic_img')" value="{{isset($card->phonetic) ?$card->phonetic->image : ''}}"/>
								</div>
								<div class="tab-pane fade" id="phonetic_link" role="tabpanel" aria-labelledby="follow-tab-classic-orange">
									<label for="phonetic_link" class="col-md-6 col-form-label text-md-right">@lang('cards.phonetic_link') :</label>
									<input name="phonetic_link" type="url" placeholder="www.example.com" title="@lang('cards.phonetic_link')" value="{{isset($card->phonetic) ?$card->phonetic->url : ''}}"/>
								</div>
								<div class="tab-pane fade" id="phonetic_music" role="tabpanel" aria-labelledby="contact-tab-classic-orange">
									<label for="phonetic_music" class="col-md-6 col-form-label text-md-right">@lang('cards.phonetic_music') :</label>
									<input name="phonetic_music" type="url" placeholder="www.example.com" title="@lang('cards.phonetic_music')" value="{{isset($card->phonetic) ?$card->phonetic->url : ''}}"/>
								</div>
							</div>

						</div>
						<!-- Classic tabs -->
				</div>
			@endif
			
			{{-- LANGUAGE --}}
			<div class="form-group row">
				<label for="language_id" class="col-md-6 col-form-label text-md-right">@lang('cards.language') :</label> 
				<input name="language_id" type="text" placeholder="@lang('cards.language')" title="@lang('cards.language')" value="{{$card->language_id}}" readonly>
			</div>

			<!--METTRE LES VALEURS PAR DEFAUT A DOMAIN ET SUBDOMAIN-->
			{{-- DOMAIN --}}
			<div class="form-group row">
				<label for="domain_id" class="col-md-6 col-form-label text-md-right">@lang('cards.domain') :</label>
				<select name="domain_id" title="@lang('cards.domain')">
					@if (!isset($card->domain))
						<option value="" >----</option>
					@endif
					@foreach($domains as $dom)
						<option value="{{ $dom->id}}" {{ (isset($card) && ($card->domain_id == $dom->id)) ? 'selected' : ''}} title="{{ $dom->content }}" >{{ $dom->content }}</option>
					@endforeach
				</select>
			</div>

			{{-- SUBDOMAIN --}}
			<div class="form-group row">
				<label for="subdomain_id" class="col-md-6 col-form-label text-md-right">@lang('cards.subdomain') :</label>
				<select name="subdomain_id" title="@lang('cards.subdomain')">
					@if (!isset($card->subdomain))
						<option value="" >----</option>
					@endif
					@foreach($subdomains as $subdom)
						<option value="{{ $subdom->id}}" title="{{ $subdom->content }}" {{ (isset($card) && ($card->subdomain_id == $subdom->id)) ? 'selected' : ''}}>{{ $subdom->content }}</option>
					@endforeach
				</select>
			</div>
			
			{{-- CONTEXT --}}
			<div class="form-group row">
				<label for="context" class="col-md-6 col-form-label text-md-right">@lang('cards.context') :</label>
				@php
					$context = $card->context
				@endphp
				@if ($card->language->isSigned)
					<input name="context" value="{{isset($context) ? $context->context_to_string : ''}}" placeholder="www.example.com" title="@lang('cards.context')" >
				@else
					<textarea name="context" value="{{isset($context) ? $context->context_to_string : ''}}" title="@lang('cards.context')" placeholder="@lang('cards.context')">{{isset($context) ? $context->context_to_string : ""}}</textarea>
				@endif
				<!-- Classic tabs -->
					<div class="classic-tabs mx-2" id="contextDiv" style="width:100%;">
					<ul class="nav tabs-orange" id="myClassicTabOrange" role="tablist">
						<li class="nav-item">
							<a class="nav-link  waves-light active show" id="profile-tab-classic-orange" data-toggle="tab" href="#context_img"
							   role="tab" aria-controls="profile-classic-orange" aria-selected="true"><i class="fas fa-image"
																										 aria-hidden="true"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-light" id="follow-tab-classic-orange" data-toggle="tab" href="#context_link"
							   role="tab" aria-controls="follow-classic-orange" aria-selected="false"><i class="fas fa-link"
																										 aria-hidden="true"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-light" id="contact-tab-classic-orange" data-toggle="tab" href="#context_music"
							   role="tab" aria-controls="contact-classic-orange" aria-selected="false"><i class="fas fa-music"
																										  aria-hidden="true"></i></a>
						</li>
					</ul>

					<div class="tab-content card" id="myClassicTabContentOrange">
						<div class="tab-pane fade active show" id="context_img" role="tabpanel" aria-labelledby="profile-tab-classic-orange">
							<label for="context_img" class="col-md-6 col-form-label text-md-right">@lang('cards.context_img') :</label>
							<input name="context_img" type="url" placeholder="www.example.com" title="@lang('cards.context_img')" value="{{ isset($context->image)? $context->image : '' }}"/>
						</div>
						<div class="tab-pane fade" id="context_link" role="tabpanel" aria-labelledby="follow-tab-classic-orange">
							<label for="context_link" class="col-md-6 col-form-label text-md-right">@lang('cards.context_link') :</label>
							<input name="context_link" type="url" placeholder="www.example.com" title="@lang('cards.context_link')" value="{{ isset( $context->url)?  $context->url : '' }}"/>
						</div>
						<div class="tab-pane fade" id="context_music" role="tabpanel" aria-labelledby="contact-tab-classic-orange">
							<label for="context_music" class="col-md-6 col-form-label text-md-right">@lang('cards.context_music') :</label>
							<input name="context_music" type="url" placeholder="www.example.com" title="@lang('cards.context_music')" value="{{ isset( $context->son)?  $context->son : '' }}"/>
						</div>
					</div>

				</div>
				<!-- Classic tabs -->
			</div>

			{{-- DEFINITION --}}
			<div class="form-group row">
				<label for="definition" class="col-md-6 col-form-label text-md-right">@lang('cards.definition') :</label>
				@php $def = $card->definition @endphp
				@if ($card->language->isSigned)
					<input name="definition" value="{{isset($def) ? $def->definition_content : ''}}" title="@lang('cards.definition')" placeholder="www.example.com">
				@else
					<textarea name="definition" value="{{isset($def) ? $def->definition_content : ''}}" title="@lang('cards.definition')" placeholder="@lang('cards.definition')">{{isset($def) ? $def->definition_content : ""}}</textarea>
				@endif
			</div>

			{{-- NOTE --}}
			<div class="form-group row">
				<label for="note" class="col-md-6 col-form-label text-md-right">@lang('cards.note') :</label>
				<input name="note" type="text" placeholder="@lang('cards.note')" title="@lang('cards.note')" value="{{isset($card->note) ? $card->note->description : ' '}}"/>
					<!-- Classic tabs -->
					<div class="classic-tabs mx-2" id="noteDiv" style="width:100%;">
						<ul class="nav tabs-orange" id="myClassicTabOrange" role="tablist">
							<li class="nav-item">
								<a class="nav-link  waves-light active show" id="profile-tab-classic-orange" data-toggle="tab" href="#note_img"
								   role="tab" aria-controls="profile-classic-orange" aria-selected="true"><i class="fas fa-image"
																											 aria-hidden="true"></i></a>
							</li>
							<li class="nav-item">
								<a class="nav-link waves-light" id="follow-tab-classic-orange" data-toggle="tab" href="#note_link"
								   role="tab" aria-controls="follow-classic-orange" aria-selected="false"><i class="fas fa-link"
																											 aria-hidden="true"></i></a>
							</li>
							<li class="nav-item">
								<a class="nav-link waves-light" id="contact-tab-classic-orange" data-toggle="tab" href="#note_music"
								   role="tab" aria-controls="contact-classic-orange" aria-selected="false"><i class="fas fa-music"
																											  aria-hidden="true"></i></a>
							</li>
						</ul>

						<div class="tab-content card" id="myClassicTabContentOrange">
							<div class="tab-pane fade active show" id="note_img" role="tabpanel" aria-labelledby="profile-tab-classic-orange">
								<label for="note_img" class="col-md-6 col-form-label text-md-right">@lang('cards.note_img') :</label>
								<input name="note_img" type="url" placeholder="www.example.com" title="@lang('cards.note_img')" value="{{ isset( $card->note->image)?   $card->note->image : '' }}"/>
							</div>
							<div class="tab-pane fade" id="note_link" role="tabpanel" aria-labelledby="follow-tab-classic-orange">
								<label for="note_link" class="col-md-6 col-form-label text-md-right">@lang('cards.note_link') :</label>
								<input name="note_link" type="url" placeholder="www.example.com" title="@lang('cards.note_link')" value="{{ isset( $card->note->url)?   $card->note->url : '' }}"/>
							</div>
							<div class="tab-pane fade" id="note_music" role="tabpanel" aria-labelledby="contact-tab-classic-orange">
								<label for="note_music" class="col-md-6 col-form-label text-md-right">@lang('cards.note_music') :</label>
								<input name="note_music" type="url" placeholder="www.example.com" title="@lang('cards.note_music')" value="{{ isset( $card->note->son)?   $card->note->son : '' }}"/>
							</div>
						</div>

					</div>
					<!-- Classic tabs -->

			</div>

			<div class="form-group row">
				<div style="margin:auto;">
					<input type="submit" class="btn btn-primary" value="@lang('cards.saveChanges')"/>
				</div>
			</div>

			@if(Auth::user()->role == \App\Enums\Roles::ADMIN)
				<div class="form-group row">
					<div style="margin:auto;">
						<a href="mailto:{{$card->owner->name}}<{{$card->owner->email}}>;?subject={{$mail['subject']}}&body={{$mail['description']}}">@lang('cards.contactOwner')</a>
					</div>
				</div>
			@endif

		</form>
		@extends('layouts.error')

	@endsection {{-- Section card-body--}}

@endsection {{-- Section content--}}
