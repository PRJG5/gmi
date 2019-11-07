@extends('layouts.app')

@section('content')
<h1> Mes Fiches </h1>
<!-- accès aux données du users via Auth::user() -->
<a>Données du user -> Nom : {{ Auth::user()->name }}</a>
@endsection