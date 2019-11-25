@extends('layouts.card')

@section('card-header')
@lang('card.card')
@endsection

@section('card-body')

<label class="col-md-6 col-form-label text-md-right">@lang('card.heading') :</label>
<label>{{$card->heading}}</label> 

<label  class="col-md-6 col-form-label text-md-right">@lang('card.language') :</label>
<label>{{$card->language_id}}</label> 

@if (!isset($card->phonetic_id))
<label  class="col-md-6 col-form-label text-md-right">@lang('card.phonetic') :</label>
<label>{{$card->phonetic_id}}</label> 
@endif

@if (!isset($card->domain_id))
<label  class="col-md-6 col-form-label text-md-right">@lang('card.domain') :</label>
<label>{{$card->domain_id}}</label> 
@endif

@if (!isset($card->subdomain_id))
<label  class="col-md-6 col-form-label text-md-right">@lang('card.subdomain') :</label>
<label>{{$card->subdomain_id}}</label> 
@endif

@if (!isset($card->definition_id))
<label  class="col-md-6 col-form-label text-md-right">@lang('card.definition') :</label>
<label>{{$card->definition_id}}</label> 
@endif

@if (!isset($card->context_id))
<label  class="col-md-6 col-form-label text-md-right">@lang('card.context') :</label>
<label>{{$card->context_id}}</label> 
@endif

@if (!isset($card->note_id))
<label  class="col-md-6 col-form-label text-md-right">@lang('card.note') :</label>
<label>{{$card->note_id}}</label>
@endif

<form action='/cards/{{$card->id}}/edit' method="get">
	@csrf
	<button type="submit" class="btn btn-primary">@lang('card.editCard')</button>
</form>

@endsection
