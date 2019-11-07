@extends('card.show', [
	'action' => $action,
	'card' => $card,
	'editable' => true,
	'languages' => $languages,
	'user' => $user,
])

@section('csrf')
@csrf
@endsection

@section('buttons')
<input type="submit" 	class="buttonLike"	value="Submit"	title="Submit" />
<input type="reset" 	class="buttonLike"	value="Clear"	title="Clear" />
@endsection

@section('error_language_id')
	@error('language_id')
		<p class="errorLike">{{ $message }}</p>
	@enderror
@show

@section('error_heading')
	@error('heading')
		<p class="errorLike">{{ $message }}</p>
	@enderror
@show

@section('error_owner_id')
	@error('owner_id')
		<p class="errorLike">{{ $message }}</p>
	@enderror
@show

@section('edit')
@endsection

@section('delete')
@endsection

@section('owner')
@show
