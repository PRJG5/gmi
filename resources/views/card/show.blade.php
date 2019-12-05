@extends('layouts.card')

@section('card-header')

	Card
@endsection
@section('card-body')
<label class="col-md-6 col-form-label text-md-right"> Vedette : </label>
<label>{{$card->heading}}</label> 

<label  class="col-md-6 col-form-label text-md-right"> Langue : </label>
<label>{{$languages->content}}</label>

@if (isset($card->phonetic))
<label  class="col-md-6 col-form-label text-md-right"> Phonetique : </label>
<label>{{$phonetic->textDescription}}</label> 
@endif

@if (isset($card->domain_id))
<label  class="col-md-6 col-form-label text-md-right"> Domaine : </label>
<label>{{$domain->content}}</label>
@endif

@if (isset($card->subdomain_id))
<label  class="col-md-6 col-form-label text-md-right"> Sous-Domaine : </label>
<label>{{$subdomain->content}}</label>
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

@if (isset($card->count_vote))
<label  class="col-md-6 col-form-label text-md-right"> Nombre de vote : </label>
<label>{{$card->count_vote}}</label>
@endif

<div>
        <form action='/cards/vote/{{$card->id}}' method="get">
        @csrf
            <button type="submit" class="btn btn-primary">Vote</button>
        </form>
    @if(in_array($card->language_id,Auth::user()->getLanguagesKeyArray()))
        <form action='/cards/{{$card->id}}/edit' method="get" style="display: inline-block;">
            @csrf
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>

        @if(Auth::user()->role != \App\Enums\Roles::USERS)
		<form style="display:inline;" action="{{ route('cards.destroy', $card) }}" method="POST">
			@csrf
			@method('DELETE')
			<button class="btn btn-danger float-right">Delete</button>
		</form>
        @endif
    @endif
</div>
@endsection
