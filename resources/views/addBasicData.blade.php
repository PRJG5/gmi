@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div style="display:none;" class="alert alert-success" role="alert" id="infosStatus">Enregistré!</div>
            <div id="form">
                <div class="form-group">
                    <label for="subdomain">Sous-domaine</label>
                    <input id="subdomain" class="form-control" name="subdomain" placeholder="Nom du sous-domaine" type="text">
                </div>
                <button onclick="addSubdomain()" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
function addSubdomain() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        $("#infosStatus").fadeIn();
        $("#subdomain").val("");
        setTimeout(function(){ $("#infosStatus").fadeOut(); }, 3000);
        
    }

    
  };
  let nameSubdomain = $('#subdomain').val();
  xhttp.open("GET", "/api/addsubdomain/" + nameSubdomain, true);
  xhttp.send();
  }
</script>