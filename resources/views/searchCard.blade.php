@extends('layouts.app')

@section('content')

<h1>Research Card</h1>
<form action="/searchCard" method="get">
    <div class="input-group">
        <input type="search" name="search" class="form-control">
        <SELECT name="languages" size="1">
        <OPTION>All
        @foreach($languages as $language)
        <OPTION>{{$language}}
        @endforeach
        </SELECT>
        <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary">Search</button>
        </span>
    </div>
</form>


@include('card.index')

@endsection

