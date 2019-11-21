@extends('layouts.card')

@section('card-header')

	Card
    
@endsection

@section('card-body')

<label class="col-md-6 col-form-label text-md-right"> Vedette : </label>
<label>{{$card->heading}}</label> 

<label  class="col-md-6 col-form-label text-md-right"> Langue : </label>
<label>{{$card->language_id}}</label> 

@if (!isset($card->phonetic_id))
<label  class="col-md-6 col-form-label text-md-right"> Phonetique : </label>
<label>{{$card->phonetic_id}}</label> 
@endif

@if (!isset($card->domain_id))
<label  class="col-md-6 col-form-label text-md-right"> Domaine : </label>
<label>{{$card->domain_id}}</label> 
@endif

@if (!isset($card->subdomain_id))
<label  class="col-md-6 col-form-label text-md-right"> Sous-Domaine : </label>
<label>{{$card->subdomain_id}}</label> 
@endif

@if (!isset($card->definition_id))
<label  class="col-md-6 col-form-label text-md-right"> Definition : </label>
<label>{{$card->definition_id}}</label> 
@endif

@if (!isset($card->context_id))
<label  class="col-md-6 col-form-label text-md-right"> Contexte : </label>
<label>{{$card->context_id}}</label> 
@endif

@if (!isset($card->note_id))
<label  class="col-md-6 col-form-label text-md-right"> Note : </label>
<label>{{$card->note_id}}</label>
@endif

<form action='/cards/{{$card->id}}/edit' method="get">
    @csrf
    <button type="submit" class="btn btn-primary">Edit</button>
</form>

@endsection
