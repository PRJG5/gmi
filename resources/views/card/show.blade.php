@extends('layouts.card')
@extends('layouts.app')

@section('card-header')

Carte
@endsection
@section('card-body')


<table class="table">
    <tbody>
        <tr>
            <th scope="row" class="text-center">Vedette : </th>
            <td class="text-left">{{$heading}}</td>
        </tr>
        <tr>
            <th scope="row" class="text-center">Langue : </th>
            <td class="text-left">{{$languages}}</td>
        </tr>

        @if(isset($phonetic))
        <tr>

            <th scope="row" class="text-center">Phonétique : </th>
            <td class="text-left">{{$phonetic}}</td>
        </tr>
        @endif
        @if(isset($domain))
        <tr>

            <th scope="row" class="text-center">Domaine : </th>
            <td class="text-left">{{$domain}}</td>
        </tr>
        @endif
        @if(isset($subdomain))
        <tr>

            <th scope="row" class="text-center">Sous domaine : </th>
            <td class="text-left">{{$subdomain}}</td>
        </tr>
        @endif
        @if(isset($context))
        <tr>

            <th scope="row" class="text-center">Contexte : </th>
            <td class="text-left">{{$context}}</td>
        </tr>
        @endif
        @if(isset($note))
        <tr>

            <th scope="row" class="text-center">Note : </th>
            <td class="text-left">{{$note}}</td>
        </tr>
        @endif
        @if(isset($vote_count))
        <tr>
            <th scope="row" class="text-center">Nombre de vote : </th>
            <td class="text-left">{{$vote_count}}</td>
        </tr>
        @endif


    </tbody>
</table>

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

<!-- <label class="col-md-6 col-form-label text-md-right"> Vedette : </label>
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
@endif -->


@endsection