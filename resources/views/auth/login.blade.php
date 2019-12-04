@extends('layouts.container')

@section('container-title')
	@lang('auth.login')
@endsection

@section('container-body')
	<form method="POST" action="{{ route('login') }}">

		@csrf

		<div class="form-group row">
			<label for="email" class="col-md-4 col-form-label text-md-right">@lang('users.email')</label>
			<div class="col-md-6">
				<input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
					   value="{{ old('email') }}" required autocomplete="email" autofocus>
				@error('email')
				<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>
		</div>

		<div class="form-group row">
			<label for="password" class="col-md-4 col-form-label text-md-right">@lang('auth.password')</label>
			<div class="col-md-6">
				<input name="password" type="password" class="form-control @error('password') is-invalid @enderror"
					   required autocomplete="current-password">
				@error('password')
				<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>
		</div>

		<div class="form-group row">
			<div class="form-check  offset-md-4">
				<input name="remember" class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
				<label for="remember" class="form-check-label">@lang('auth.rememberMe')</label>
			</div>
		</div>

		<div class="form-group row offset-md-4">
			<button type="submit" class="btn btn-primary">@lang('auth.login')</button>
			@if (Route::has('password.request'))
				<a class="btn btn-link" href="{{ route('password.request') }}">@lang('auth.passwordForgotten')</a>
			@endif
		</div>
	</form>
@endsection
