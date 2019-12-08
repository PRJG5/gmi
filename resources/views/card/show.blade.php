@extends('layouts.card')
@extends('layouts.app')

@section('card-header')

Card
@endsection
@section('card-body')

<label class="col-md-6 col-form-label text-md-right"> Vedette : </label>
<label>{{$heading}}</label>

<label class="col-md-6 col-form-label text-md-right"> Langue : </label>
<label>{{$languages}}</label>

@if (isset($phonetic))
<label class="col-md-6 col-form-label text-md-right"> Phonetique : </label>
<label>{{$phonetic}}</label>
@endif

@if (isset($domain))
<label class="col-md-6 col-form-label text-md-right"> Domaine : </label>
<label>{{$domain}}</label>
@endif

@if (isset($subdomain))
<label class="col-md-6 col-form-label text-md-right"> Sous-Domaine : </label>
<label>{{$subdomain}}</label>
@endif

@if (isset($definition))
<label class="col-md-6 col-form-label text-md-right"> Definition : </label>
<label>{{$definition}}</label>
@endif

@if (isset($context))
<label class="col-md-6 col-form-label text-md-right"> Contexte : </label>
<label>{{$context}}</label>
@endif

@if (isset($note) )
<label class="col-md-6 col-form-label text-md-right"> Note : </label>
<label>{{$note}}</label>
@endif

@if (isset($vote_count))
<label class="col-md-6 col-form-label text-md-right"> Nombre de vote : </label>
<label>{{$vote_count}}</label>
@endif

<div style="display:flex;justify-content: space-evenly;">
    <form action='/cards/vote/{{$card->id}}' method="get">
        @csrf
        <button type="submit" class="btn btn-primary">Vote</button>
    </form>

    <!-- A VERIFIER L EMPLACEMENT  -->
    <form action='/cards/{{$card_id}}/linkList' method="get">
        @csrf
        <button type="submit" class="btn btn-primary">Liste des liens</button>
    </form>

    <form action='/cards/{{$card_id}}/link' method="get">
        @csrf
        <button type="submit" class="btn btn-primary">Faire un lien</button>
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
    <!-- <form action="{{ route('cards.destroy', $card) }}" method="POST"> -->
    <form action="{{ route('cards.destroy', $card_id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger float-right">Delete</button>
    </form>
    @endif
    @endif
</div>
@endsection