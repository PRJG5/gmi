@extends('layouts.board')

@section('card-header')
@lang('misc.importLanguages')
@endsection

@section('card-body')
<form action="{{ route('importLanguages') }}" method="POST" enctype="multipart/form-data">
	@csrf
	<input type="file" name="file" class="form-control" accept=".xls,.xlsx" required><br>
	<button type="submit" class="btn btn-success">@lang('misc.importData')</button>
</form>
@endsection
