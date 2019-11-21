@extends('card.editable', [
	'action' => "/cards/{$card->id}",
	'card' => $card,
	'languages' => $languages,
	'owner' => $owner,
])

@section('patch')
@method('PATCH')
@endsection

@section('buttons')
<input type="submit" 	class="buttonLike"	value="Submit"	title="Submit" />
<input type="reset" 	class="buttonLike"	value="Clear"	title="Clear" />
<a href="mailto:{{$owner->email}}?subject={{$mail['subject']}}&body={{$mail['description']}}" class="buttonLike">Send mail</a>
@endsection
