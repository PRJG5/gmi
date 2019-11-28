@extends('layouts.card')

@section('card-header')

	Card
    
@endsection

@section('card-body')

<label class="col-md-6 col-form-label text-md-right"> Vedette : </label>
<label>{{$card->heading}}</label> 

<label  class="col-md-6 col-form-label text-md-right"> Langue : </label>
<label>{{$card->language_id}}</label>   

@if (isset($card->phonetic))
<label  class="col-md-6 col-form-label text-md-right"> Phonetique : </label>
<label>{{$phonetic->textDescription}}</label> 
@endif

@if (isset($card->domain_id))
<label  class="col-md-6 col-form-label text-md-right"> Domaine : </label>
<label>{{$card->domain_id}}</label> 
@endif

@if (isset($card->subdomain_id))
<label  class="col-md-6 col-form-label text-md-right"> Sous-Domaine : </label>
<label>{{$card->subdomain_id}}</label> 
@endif

@if (isset($card->definition_id))
<label  class="col-md-6 col-form-label text-md-right"> Definition : </label>
<label>{{$definition->definition_content}}</label> 
@endif

@if (isset($card->context_id))
<label  class="col-md-6 col-form-label text-md-right"> Contexte : </label>
<label>{{$context->context_to_string}}</label> 
@endif

@if (isset($card->note_id))
<label  class="col-md-6 col-form-label text-md-right"> Note : </label>
<label>{{$note->description}}</label>
@endif
<div>
        <form action='/cards/{{$card->id}}/edit' method="get" style="display: inline-block;">
            @csrf
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    @if(Auth::user()->role != \App\Enums\Roles::USERS)
        <button class="btn btn-danger float-right" style="">Supprimer</button>
    @endif
</div>
@endsection
