@extends('layouts.container')

@section('container-title')
	@lang('auth.register')
@endsection

@section('container-body')
	<form method="POST" action="{{ route('register') }}">

		@csrf

		<div class="form-group row">
			<label for="name" class="col-md-4 col-form-label text-md-right">@lang('users.name')</label>
			<div class="col-md-6">
				<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
					   value="{{ old('name') }}" required autocomplete="name" autofocus>
				@error('name')
				<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>
		</div>

		<div class="form-group row">
			<label for="email" class="col-md-4 col-form-label text-md-right">@lang('users.email')</label>
			<div class="col-md-6">
				<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
					   value="{{ old('email') }}" required autocomplete="email">
				@error('email')
				<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>
		</div>

		<div class="form-group row">
			<label for="password" class="col-md-4 col-form-label text-md-right">@lang('auth.password')</label>
			<div class="col-md-6">
				<input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
					   name="password" required minlength="8" autocomplete="new-password">
				@error('password')
				<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>
		</div>

		<div class="form-group row">
			<label for="password-confirm"
				   class="col-md-4 col-form-label text-md-right">@lang('auth.confirmPassword')</label>
			<div class="col-md-6">
				<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
					   minlength="8" autocomplete="new-password">
			</div>
		</div>

		<div class="form-group row">
			<label for="languages" class="col-md-4 col-form-label text-md-right">@lang('users.spokenLanguages')</label>
			<div class="col-md-6">
				<select id="languages" class="form-control @error('languages') is-invalid @enderror" name="languages[]"
						required multiple>
					@foreach ($languages as $language)
						<option value="{{ $language->slug}}">{{$language->content}}</option>
					@endforeach
				</select>
				@error('languages')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>

		<div class="form-group row mb-0">
			<div class="col-md-6 offset-md-4">
				<button type="submit" class="btn btn-primary">@lang('auth.register')</button>
			</div>
		</div>
	</form>
@endsection
