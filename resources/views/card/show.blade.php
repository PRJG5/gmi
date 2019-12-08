
@extends('layouts.card')
@extends('layouts.app')

@section('card-header')

	Card
@endsection
@section('card-body')
<label class="col-md-6 col-form-label text-md-right"> Vedette : </label>
<label>{{$card->heading}}</label> 

@if ($card->isSignedLanguage())
    <a href="{{$card->headingURL}}" target="_blank">Vidéo</a>
@endif

<label  class="col-md-6 col-form-label text-md-right"> Langue : </label>
<label>{{$languages->content}}</label>

@if (isset($card->phonetic) && (!$card->isSignedLanguage()))
<label  class="col-md-6 col-form-label text-md-right"> Phonetique : </label>
<label>{{$card->phonetic->textDescription}}</label> 
@endif

@if (isset($card->domain_id))
<label  class="col-md-6 col-form-label text-md-right"> Domaine : </label>
<label>{{$card->domain->content}}</label>
@endif

@if (isset($card->subdomain_id))
<label  class="col-md-6 col-form-label text-md-right"> Sous-Domaine : </label>
<label>{{$subdomain->content}}</label>
@endif

@if (isset($card->definition_id))
    <label  class="col-md-6 col-form-label text-md-right"> Definition : </label>
    @if ($card->isSignedLanguage())
        <a href="{{$definition->definition_content}}" target="_blank">Vidéo</a>
    @else
        <label>{{$definition->definition_content}}</label> 
    @endif
@endif

@if (isset($card->context_id))
    <label  class="col-md-6 col-form-label text-md-right"> Contexte : </label>
    @if ($card->isSignedLanguage())
        <a href="{{$context->context_to_string}}" target="_blank">Vidéo</a>
    @else
        <label>{{$context->context_to_string}}</label> 
    @endif
@endif

@if (isset($card->note_id))
    <label  class="col-md-6 col-form-label text-md-right"> Note : </label>
    @if ($card->isSignedLanguage())
        <a href="{{$note->description}}" target="_blank">Vidéo</a>
    @else
        <label>{{$note->description}}</label>
    @endif
@endif

@if (isset($card->count_vote))
<label  class="col-md-6 col-form-label text-md-right"> Nombre de vote : </label>
<label>{{$card->count_vote}}</label>
@endif

<div style="display:flex;justify-content: space-evenly;">
        <form action='/cards/vote/{{$card->id}}' method="get">
        @csrf
            <button type="submit" class="btn btn-primary">Vote</button>
        </form>
    @if(in_array($card->language_id,Auth::user()->getLanguagesKeyArray()))
        @if(!isset($card->validation_id))
            <form action='/cards/{{$card->id}}/edit' method="get">
                @csrf
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        @endif
        @if(Auth::user()->role == \App\Enums\Roles::ADMIN && isset($card->validation_id))
                <form action="{{ route('cards.removeValidation', $card) }}" method="POST">
                    @csrf
                    <button class="btn btn-warning float-right">Remove validation</button>
                </form>
        @endif
         @if(Auth::user()->role != \App\Enums\Roles::USERS)
                <form action="{{ route('cards.destroy', $card) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger float-right">Delete</button>
                </form>
         @endif
    @endif
</div>
@endsection
