@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                            <div class="card-header">@yield('card-header')</div>
                            <div class="card-body">@yield('card-body')</div>
                    </div>
            </div>
        </div>
    </div>

<div>
@yield('under-card')
</div>
@endsection