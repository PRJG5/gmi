@extends('card.fragShow')
@section('card-header')

Carte {{$heading}}
@endsection
@section('card-button')

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