{{-- 
    View to display all cards from an user. The cards are found with the user id. Ajax is used
--}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="form">
                <div class="form-group">
                    <label for="nameAuthor">Recherche par auteur</label>
                    <select id="authors" class="form-control" name="author" required>
                        @foreach ($authors as $author)
                            <option value="{{$author->id}}">{{$author->name}} ({{$author->email}})</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" onclick="searchCards()">Rechercher</button>
            </div>

            
            <div id="listOfCards">
                {{-- TODO: Need to extend the layout --}}
            </div>
    </div>
</div>
@endsection

<script>
/** 
* Get the cards of the user id. Update the view with the card template 
*/
function searchCards() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        $("#listOfCards").empty(); //Clear to add the new cards
        var xhttp2 = new XMLHttpRequest();
        xhttp2.onreadystatechange = function() {
            $("#listOfCards").append(this.responseText);
        };

        cards = JSON.parse(this.responseText);
        cards.forEach(card => {
            xhttp2.open("GET", "/cards/" + card["card_id"], true);
            xhttp2.send();
        });
    }
  };
  let authorEmail = $('#authors').find(":selected").val();
  xhttp.open("GET", "/api/getAllCardsFromUsers/" + authorEmail, true);
  xhttp.send();
  }
</script>