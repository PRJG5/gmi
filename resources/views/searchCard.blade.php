@extends('layouts.app')

@section('content')

<h1>Research Card</h1>
<form action="/searchCard" method="get">
    <div class="input-group">
        <input type="search" name="search" class="form-control">
        <SELECT name="languages" size="1">
        @foreach($languages as $language)
        <OPTION>{{$language}}
        @endforeach
        </SELECT>
        <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary">Search</button>
        </span>
    </div>
</form>


<table>
    <tr>
        <th>ID</th>
        <th>Heading</th>
        <!-- <th>Domain</th>
        <th>Sub-Domaine</th> -->
        <th>Language</th>
        <!--  <th>User</th> -->
       <!-- <th></th> -->
    </tr>
    @foreach($cards as $card)
        <tr>
            <td><a href='{{url('card/' . $card->id ) }}'>
{{$card->card_id}}</a></td>
            <td>{{$card->heading}}</td>
            <!-- <td>{{$card->domain}}</td>
        <td>{{$card->sub_domain}}</td>
        -->
            <td>{{$card->language_id}}</td> 

            <!--   <td>{{$card->definition}}</td>
            <td>{{$card->user}}</td> -->
        </tr>
    @endforeach
</table>

@endsection