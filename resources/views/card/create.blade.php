@extends('card.editable', [
	'action' => '/cards',
	'card' => null,
	'languages' => $languages,
	'owner' => null,
])

@section('card_id')
@endsection

@section('owner_id')
@endsection

@section('buttons')
<input type="submit" 	class="buttonLike"	value="Submit"	title="Submit" />
<input type="reset" 	class="buttonLike"	value="Clear"	title="Clear" />
@endsection

@foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach
