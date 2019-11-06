@extends('layouts.app')

@section('content')

<h1>Research Card</h1>
<form action="/search" method="get">
    <div class="form-group">
        <input type="search" name="search" class="form-control">
        <span class="form-group-btn">
            <button type="submit" class="btn btn-primary">Search</button>
        </span>
    </div>

    </form>
@endsection