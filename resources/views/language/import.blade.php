@extends('layouts.board')

@section('card-header')
@lang('misc.importLanguages')
@endsection

@section('card-body')
<form action="{{ route('importLanguages') }}" method="POST" enctype="multipart/form-data" class="">
	@csrf
	<div class="form-group">
		<input type="file" name="file" class="form-control-file" accept=".xls,.xlsx" required><br>
	</div>
	<div class="form-check">
		<button type="submit" class="btn btn-success">@lang('misc.importData')</button>
	</div>
</form>
@endsection
