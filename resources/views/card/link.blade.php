@extends('layouts.card')
@extends ('layouts.app')
@section('card-header')

La carte d'origine

@endsection


@section('card-body')


<table class="table">
  <tbody>
    <tr>
      <th scope="row" class="text-center">Vedette : </th>
      <td class="text-left">{{$cardOrigin->getHeading()}}</td>
    </tr>
    <tr>
      <th scope="row" class="text-center">Langue : </th>
      <td class="text-left">{{$cardOrigin->getLanguage()}}</td>
    </tr>

    @if(isset($cardOrigin->phonetic))
    <tr>

      <th scope="row" class="text-center">Phonétique : </th>
      <td class="text-left">{{$cardOrigin->getPhonetic()}}</td>
    </tr>
    @endif
    @if(isset($cardOrigin->domain_id))
    <tr>

      <th scope="row" class="text-center">Domaine : </th>
      <td class="text-left">{{$cardOrigin->getDomain()}}</td>
    </tr>
    @endif
    @if(isset($cardOrigin->subdomain_id))
    <tr>

      <th scope="row" class="text-center">Sous domaine : </th>
      <td class="text-left">{{$cardOrigin->getSubdomain()}}</td>
    </tr>
    @endif
    @if(isset($cardOrigin->context_id))
    <tr>

      <th scope="row" class="text-center">Contexte : </th>
      <td class="text-left">{{$cardOrigin->getContext()}}</td>
    </tr>
    @endif
    @if(isset($cardOrigin->note_id))
    <tr>

      <th scope="row" class="text-center">Note : </th>
      <td class="text-left">{{$cardOrigin->getNote()}}</td>
    </tr>
    @endif
    <!-- @if(isset($vote_count))
        <tr>
            <th scope="row" class="text-center">Nombre de vote : </th>
            <td class="text-left">{{$cardOrigin->getvote_count}}</td>
        </tr>
        @endif -->


  </tbody>
</table>
<!-- <label class="col-md-6 col-form-label text-md-right"> Vedette : </label>
<label>{{$cardOrigin->getHeading()}}</label>

<label class="col-md-6 col-form-label text-md-right"> Langue : </label>
<label>{{$cardOrigin->getLanguage()}}</label>

@if (isset($cardOrigin->phonetic))
<label class="col-md-6 col-form-label text-md-right"> Phonetique : </label>
<label>{{$cardOrigin->getPhonetic()}}</label>
@endif

@if (isset($cardOrigin->domain_id))
<label class="col-md-6 col-form-label text-md-right"> Domaine : </label>
<label>{{$cardOrigin->getDomain()}}</label>
@endif

@if (isset($cardOrigin->subdomain_id))
<label class="col-md-6 col-form-label text-md-right"> Sous-Domaine : </label>
<label>{{$cardOrigin->getSubdomain()}}</label>
@endif

@if (isset($cardOrigin->definition_id))
<label class="col-md-6 col-form-label text-md-right"> Definition : </label>
<label>{{$cardOrigin->getDefinition()}}</label>
@endif

@if (isset($cardOrigin->context_id))
<label class="col-md-6 col-form-label text-md-right"> Contexte : </label>
<label>{{$cardOrigin->getContext()}}</label>
@endif

@if (isset($cardOrigin->note_id))
<label class="col-md-6 col-form-label text-md-right"> Note : </label>
<label>{{$cardOrigin->getNote()}}</label>
@endif -->

@endsection
@section("under-card")



<div class="container p-4">
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">



    @foreach ($cardLinked as $card)

    @if($loop->first)
    <div class="carousel-item active">
      @else
      <div class="carousel-item">
        @endif

        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header blue white-text text-center">Les autres cartes </div>
              <div class="card-body">
                <table class="table">
                  <tbody>
                    <tr>
                      <th scope="row" class="text-center">Vedette : </th>
                      <td class="text-left">{{$card->getHeading()}}</td>
                    </tr>
                    <tr>
                      <th scope="row" class="text-center">Langue : </th>
                      <td class="text-left">{{$card->getLanguage()}}</td>
                    </tr>

                    @if(isset($card->phonetic))
                    <tr>

                      <th scope="row" class="text-center">Phonétique : </th>
                      <td class="text-left">{{$cardOrigin->getPhonetic()}}</td>
                    </tr>
                    @endif
                    @if(isset($cardOrigin->domain_id))
                    <tr>

                      <th scope="row" class="text-center">Domaine : </th>
                      <td class="text-left">{{$card->getDomain()}}</td>
                    </tr>
                    @endif
                    @if(isset($card->subdomain_id))
                    <tr>

                      <th scope="row" class="text-center">Sous domaine : </th>
                      <td class="text-left">{{$card->getSubdomain()}}</td>
                    </tr>
                    @endif
                    @if(isset($card->context_id))
                    <tr>

                      <th scope="row" class="text-center">Contexte : </th>
                      <td class="text-left">{{$card->getContext()}}</td>
                    </tr>
                    @endif
                    @if(isset($card->note_id))
                    <tr>

                      <th scope="row" class="text-center">Note : </th>
                      <td class="text-left">{{$card->getNote()}}</td>
                    </tr>
                    @endif
                   
                    <!-- @if(isset($vote_count))
        <tr>
            <th scope="row" class="text-center">Nombre de vote : </th>
            <td class="text-left">{{$cardOrigin->getvote_count}}</td>
        </tr>
        @endif -->


                  </tbody>
                </table>
                <!-- <div class="block center">
                <label class="col-md-6 col-form-label text-md-right"> Vedette: </label>
                <label>{{$card->getHeading()}}</label>

                <label class="col-md-6 col-form-label text-md-right"> Langue : </label>
                <label>{{$card->getLanguage()}}</label>

                @if (isset($card->phonetic))
                <label class="col-md-6 col-form-label text-md-right"> Phonetique : </label>
                <label>{{$card->getPhonetic()}}</label>
                @endif

                @if (isset($card->domain_id))
                <label class="col-md-6 col-form-label text-md-right"> Domaine : </label>
                <label>{{$card->getDomain()}}</label>
                @endif

                @if (isset($card->subdomain_id))
                <label class="col-md-6 col-form-label text-md-right"> Sous-Domaine : </label>
                <label>{{$card->getSubdomain()}}</label>
                @endif

                @if (isset($card->definition_id))
                <label class="col-md-6 col-form-label text-md-right"> Definition : </label>
                <label>{{$card->getDefinition()}}</label>
                @endif

                @if (isset($card->context_id))
                <label class="col-md-6 col-form-label text-md-right"> Contexte : </label>
                <label>{{$card->getContext()}}</label>
                @endif

                @if (isset($card->note_id))
                <label class="col-md-6 col-form-label text-md-right"> Note : </label>
                <label>{{$card->getNote()}}</label>
                @endif

                <label class="col-md-6 col-form-label text-md-right"> Nombre de vote : </label>
                <label>{{$card->getCountVoteAttribute()}}</label>

              </div> -->
              </div>
              <div style="display:flex;justify-content: space-evenly;">
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
      </div>
      @endforeach
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color:black;"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" style="background-color:black;"></span>
        <span class="sr-only" style="color:black;">Next</span>
      </a>
    </div>
  </div>
  <!-- <div class="my-slider">
  @foreach ($cardLinked as $card)
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Les autres cartes </div>
          <div class="card-body">

            <div class="block center">
              <label class="col-md-6 col-form-label text-md-right"> Vedette: </label>
              <label>{{$card->getHeading()}}</label>

              <label class="col-md-6 col-form-label text-md-right"> Langue : </label>
              <label>{{$card->getLanguage()}}</label>

              @if (isset($card->phonetic))
              <label class="col-md-6 col-form-label text-md-right"> Phonetique : </label>
              <label>{{$card->getPhonetic()}}</label>
              @endif

              @if (isset($card->domain_id))
              <label class="col-md-6 col-form-label text-md-right"> Domaine : </label>
              <label>{{$card->getDomain()}}</label>
              @endif

              @if (isset($card->subdomain_id))
              <label class="col-md-6 col-form-label text-md-right"> Sous-Domaine : </label>
              <label>{{$card->getSubdomain()}}</label>
              @endif

              @if (isset($card->definition_id))
              <label class="col-md-6 col-form-label text-md-right"> Definition : </label>
              <label>{{$card->getDefinition()}}</label>
              @endif

              @if (isset($card->context_id))
              <label class="col-md-6 col-form-label text-md-right"> Contexte : </label>
              <label>{{$card->getContext()}}</label>
              @endif

              @if (isset($card->note_id))
              <label class="col-md-6 col-form-label text-md-right"> Note : </label>
              <label>{{$card->getNote()}}</label>
              @endif

              <label class="col-md-6 col-form-label text-md-right"> Nombre de vote : </label>
              <label>{{$card->getCountVoteAttribute()}}</label>

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
</div> -->
  @endsection

  @include("layouts.error")

  @section("script")
  <!-- <script>
  $('.my-slider').slick({
    centerMode: true,
    slidesToShow: 1,
    infinite: true,
    nextArrow: $('.la.la-angle-right.arrow-slider'),
    prevArrow: $('.la.la-angle-left.arrow-slider'),
  });
</script> -->
  @endsection