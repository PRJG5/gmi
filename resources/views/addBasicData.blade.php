@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div style="display:none;" class="alert" role="alert" id="infosStatus"></div>
            <div id="form">
                <div class="form-group">
                    <label for="subdomain">Sous-domaine</label>
                    <input id="subdomain" class="form-control" name="subdomain" placeholder="Nom du sous-domaine" type="text">
                </div>
                <button onclick="addSubdomain()" class="btn btn-primary">Ajouter</button>
            </div>
            <br>
            <!-- language -->
            <div id="form">
                <div class="form-group">
                    <label for="language">Langue</label>
                    <input id="language" class="form-control" name="language" placeholder="Nom de la langue" type="text">
                    <label for="language">Code ISO</label>
                    <input id="codeIso" class="form-control" name="codeIso" placeholder="Code ISO" type="text">
                </div><br>
                <button onclick="addLanguage()" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </div>
</div>
@endsection

<script>

    function alertBt(parseJson) {
        if (parseJson['error'] != undefined) {
                $("#infosStatus").removeClass("alert-success");
                $("#infosStatus").addClass("alert-danger");
                $("#infosStatus").text(parseJson['error']);
            } else if (parseJson['success'] != undefined) {
                $("#infosStatus").removeClass("alert-danger");
                $("#infosStatus").addClass("alert-success");
                $("#infosStatus").text(parseJson['success']);
            }
            $("#infosStatus").fadeIn();
            setTimeout(function(){ $("#infosStatus").fadeOut(); }, 3000);
    }
    function addSubdomain() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alertBt(JSON.parse(this.responseText));
                $("#subdomain").val("");
            }
        };
        let nameSubdomain = $('#subdomain').val();
        xhttp.open("GET", "/api/addsubdomain/" + nameSubdomain, true);
        xhttp.send();
    }

    function addLanguage() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alertBt(JSON.parse(this.responseText));
                $("#language").val("");
                $("#codeIso").val("");
            }
        };
        let nameLanguage = $('#language').val();
        let codeIso = $("#codeIso").val();
        xhttp.open("GET", "/api/addlanguage/" + nameLanguage + "/code/" + codeIso, true);
        xhttp.send();
    }
    
</script>