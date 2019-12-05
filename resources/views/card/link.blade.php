@extends('layouts.card')

@section('card-header')

Card origin
    
@endsection


@section('card-body')
<label class="col-md-6 col-form-label text-md-right"> Vedette : </label>
<label>{{$cardOrigin->heading}}</label> 

<label  class="col-md-6 col-form-label text-md-right"> Langue : </label>
<label>{{$cardOrigin->language_id}}</label>   

@if (isset($cardOrigin->phonetic))
<label  class="col-md-6 col-form-label text-md-right"> Phonetique : </label>
<label>{{$cardOrigin->getPhonetic()}}</label> 
@endif

@if (isset($cardOrigin->domain_id))
<label  class="col-md-6 col-form-label text-md-right"> Domaine : </label>
<label>{{$cardOrigin->domain_id}}</label> 
@endif

@if (isset($cardOrigin->subdomain_id))
<label  class="col-md-6 col-form-label text-md-right"> Sous-Domaine : </label>
<label>{{$cardOrigin->subdomain_id}}</label> 
@endif

@if (isset($cardOrigin->definition_id))
<label  class="col-md-6 col-form-label text-md-right"> Definition : </label>
<label>{{$cardOrigin->getDefinition()->definition_content}}</label> 
@endif

@if (isset($cardOrigin->context_id))
<label  class="col-md-6 col-form-label text-md-right"> Contexte : </label>
<label>{{$cardOrigin->getContext()->context_to_string}}</label> 
@endif

@if (isset($cardOrigin->note_id))
<label  class="col-md-6 col-form-label text-md-right"> Note : </label>
<label>{{$cardOrigin->getNote()->description}}</label>
@endif

@endsection
@section("under-card")

<div class="my-slider" >                      
    @foreach ($cardLinked as $card)
    <div class="container">
    <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                            <div class="card-header">SALUT</div>
                            <div class="card-body">

    <div class="block center">
    <label class="col-md-6 col-form-label text-md-right"> Vedette: </label>
    <label>{{$card->heading}}</label> 

    <label class="col-md-6 col-form-label text-md-right"> Langue : </label>
    <label>{{$card->language_id}}</label>   

    @if (isset($card->phonetic))
    <label class="col-md-6 col-form-label text-md-right"> Phonetique : </label>
    <label>{{$card->getPhonetic()}}</label> 
    @endif

    @if (isset($card->domain_id))
    <label class="col-md-6 col-form-label text-md-right"> Domaine : </label>
    <label>{{$card->domain_id}}</label> 
    @endif

    @if (isset($card->subdomain_id))
    <label class="col-md-6 col-form-label text-md-right"> Sous-Domaine : </label>
    <label>{{$card->subdomain_id}}</label> 
    @endif

    @if (isset($card->definition_id))
    <label class="col-md-6 col-form-label text-md-right"> Definition : </label>
    <label>{{$card->getDefinition()->definition_content}}</label> 
    @endif

    @if (isset($card->context_id))
    <label class="col-md-6 col-form-label text-md-right"> Contexte : </label>
    <label>{{$card->getContext()->context_to_string}}</label> 
    @endif

    @if (isset($card->note_id))
    <label class="col-md-6 col-form-label text-md-right"> Note : </label>
    <label>{{$card->getNote()->description}}</label>
    @endif
    </div>
    </div>
    <form action='{{$card->id}}/link' method="get">
    @csrf
    <input value="{{$card->id}}" type="hidden" name="card">
    <input value="{{$cardOrigin->id}}" type="hidden" name="cardOrigin">
    <button type="submit" class="btn btn-primary">Link</button>
    </form>
    </div>
    </div>
    </div>
    </div>
    @endforeach
    </div>
    <div class="controls text-center">
                      <i class="la la-angle-left arrow-slider slick-arrow" style="font-size:28px"></i>
                      <i class="la la-angle-right arrow-slider slick-arrow" style="font-size:28px"></i>
    </div>
@endsection

@include("layouts.error")


