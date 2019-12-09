
@extends('layouts.card' )


@section('card-body')
<table class="table">
    <tbody>
        <tr>
            <th scope="row" class="text-center">Vedette : </th>
            <td class="text-left">{{$heading}}</td>
        </tr>
        <tr>
            <th scope="row" class="text-center">Langue : </th>
            <td class="text-left">{{$languages}}</td>
        </tr>

        @if(isset($phonetic))
        <tr>

            <th scope="row" class="text-center">Phonétique : </th>
            <td class="text-left">{{$phonetic}}</td>
        </tr>
        @endif
        @if(isset($domain))
        <tr>

            <th scope="row" class="text-center">Domaine : </th>
            <td class="text-left">{{$domain}}</td>
        </tr>
        @endif
        @if(isset($subdomain))
        <tr>

            <th scope="row" class="text-center">Sous domaine : </th>
            <td class="text-left">{{$subdomain}}</td>
        </tr>
        @endif
        @if(isset($context))
        <tr>

            <th scope="row" class="text-center">Contexte : </th>
            <td class="text-left">{{$context}}</td>
        </tr>
        @endif
        @if(isset($note))
        <tr>

            <th scope="row" class="text-center">Note : </th>
            <td class="text-left">{{$note}}</td>
        </tr>
        @endif
        @if(isset($vote_count))
        <tr>
            <th scope="row" class="text-center">Nombre de vote : </th>
            <td class="text-left">{{$vote_count}}</td>
        </tr>
        @endif


    </tbody>
     
</table>
@yield('card-button')   
@endsection