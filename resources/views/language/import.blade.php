@extends('layouts.app')

@section('content')
<form action="{{ route('importLanguage') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" class="form-control">
    <br>
    <button class="btn btn-success">import Data </button>
</form>

@endsection