@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifier son profil') }}</div>

                <div class="card-body justify-content-center">



                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        <label for="name" class="col-md-4 col-form-label text-md-left">{{Auth::user()->name}}</label>

                    </div>
                    <form method="POST" action="{{ route('modifyMail') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6 justify-content-center">
                                <input placeholder="{{Auth::user()->email}} " id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                @if(session()->has('validEmail'))
                                <!-- <span class="valid-feedback" role="alert">
                                    <strong></strong>
                                </span> -->
                                <div class="alert alert-success">
                                    {{ session()->get('validEmail') }}
                                </div>
                                @endif
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Changer l\'email') }}
                                </button>

                            </div>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('modifyPassword') }}">
                        @csrf
                        
                        <!--  <div class="collapse" id="collapseExample"> -->
                        <div class="form-group row">
                            <label for="oldPassword" class="col-md-4 col-form-label text-md-right">{{ __('Old password') }}</label>

                            <div class="col-md-6">


                                <input id="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword">

                                @error('oldPassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">


                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="passwordConfirm">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="passwordConfirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="passwordConfirm" type="password" class="form-control" name="passwordConfirm" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sdqsd" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Changer le mot de passe') }}
                                </button>
                                @if(session()->has('errorPswd'))
                                <!-- <span class="valid-feedback" role="alert">
                                    <strong></strong>
                                </span> -->
                                <div class="alert alert-sucess">
                                    {{ session()->get('errorPswd') }}
                                </div>
                                @endif
                               
                                @if(session()->has('Passwordsuccess'))
                                <!-- <span class="valid-feedback" role="alert">
                                    <strong></strong>
                                </span> -->
                                <div class="alert alert-success">
                                    {{ session()->get('Passwordsuccess') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>
                   
                    <!--  </div> -->
                    <form method="POST" action="{{ route('modifyLanguages') }}">
                        <div class="form-group row">
                            <label for="languages" class="col-md-4 col-form-label text-md-right">{{ __('Langues parlées') }}</label>

                            <div class="col-md-6">
                                <select id="languages" class="form-control @error('languages') is-invalid @enderror" name="languages[]" required multiple>
                                    @foreach ($languages as $language)
                                    <option value="{{$language->slug}}">{{$language->content}}</option>
                                    @endforeach
                                </select>

                                @error('languages')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Ajouter les langues') }}
                            </button>

                        </div>
                    </form>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection