
@extends('layouts.card')
@extends('layouts.app')

@section('card-header')

	Card
@endsection
@section('card-body')

<label class="col-md-6 col-form-label text-md-right"> Vedette : </label>
<label>{{$heading}}</label> 

<label  class="col-md-6 col-form-label text-md-right"> Langue : </label>
<label>{{$languages}}</label>

@if (isset($phonetic))
<label  class="col-md-6 col-form-label text-md-right"> Phonetique : </label>
<label>{{$phonetic}}</label>    
@endif

@if (isset($domain))
<label  class="col-md-6 col-form-label text-md-right"> Domaine : </label>
<label>{{$domain}}</label>
@endif

@if (isset($subdomain))
<label  class="col-md-6 col-form-label text-md-right"> Sous-Domaine : </label>
<label>{{$subdomain}}</label>
@endif

@if (isset($definition))
<label  class="col-md-6 col-form-label text-md-right"> Definition : </label>
<label>{{$definition}}</label> 
@endif

@if (isset($context))
<label  class="col-md-6 col-form-label text-md-right"> Contexte : </label>
<label>{{$context}}</label> 
@endif

@if (isset($note) )
<label  class="col-md-6 col-form-label text-md-right"> Note : </label>
<label>{{$note}}</label>
@endif

@if (isset($vote_count))
<label  class="col-md-6 col-form-label text-md-right"> Nombre de vote : </label>
<label>{{$vote_count}}</label>
@endif

<div>
        <form action='/cards/vote/{{$card_id}}' method="get">
        @csrf
            <button type="submit" class="btn btn-primary">Vote</button>
        </form>
    @if(in_array($language_id,Auth::user()->getLanguagesKeyArray()))
        <form action='/cards/{{$card_id}}/edit' method="get" style="display: inline-block;">
            @csrf
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>

        <form action='/cards/{{$card_id}}/linkList' method="get">
            @csrf
            <button type="submit" class="btn btn-primary">Liste des liens</button>
        </form>

        <form action='/cards/{{$card_id}}/link' method="get">
            @csrf
            <button type="submit" class="btn btn-primary">Faire un lien</button>
        </form>

        @if(Auth::user()->role != \App\Enums\Roles::USERS)
		<form style="display:inline;" action="{{ route('cards.destroy', $card_id) }}" method="POST">
			@csrf
			@method('DELETE')
			<button class="btn btn-danger float-right">Delete</button>
		</form>
        @endif

        
    @endif
</div>
@endsection
