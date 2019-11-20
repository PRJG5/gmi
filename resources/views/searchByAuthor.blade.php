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
        document.getElementById("listOfCards").innerHTML = this.responseText;
        //TODO: need to update the view according to the layout
    }
  };
  let authorEmail = $('#authors').find(":selected").val();
  xhttp.open("GET", "/api/getAllCardsFromUsers/" + authorEmail, true);
  xhttp.send();
}
</script>