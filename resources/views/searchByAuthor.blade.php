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
            </div>
        </div>
    </div>
</div>
@endsection

<script>
/** 
* Gets the cards of the user id.
* Updates the view with the card template
*/
async function searchCards() {
	const author = $('#authors').find(":selected").val();
	makeRequest("GET", `/searchByUser/${author}`)
	.then((result) => {
		$("#listOfCards").html(result);
		
	})
	.catch((error) => {
		console.error(`Error happened during xhr.\n${error.status} - ${error.statusText}`);
	});
}

/**
 * @param {string} the method of the request
 * @param {string} the url to make the request to
 * @return a promise of request
 */
function makeRequest (method, url) {
	return new Promise((resolve, reject) => {
		const xhr = new XMLHttpRequest();
		xhr.open(method, url);
		xhr.onload = () => {
			if (xhr.status >= 200 && xhr.status < 300) {
				resolve(xhr.response);
			} else {
				reject({
					status: xhr.status,
					statusText: xhr.statusText,
				});
			}
		};
		xhr.onerror = () => {
			reject({
				status: xhr.status,
				statusText: xhr.statusText,
			});
		};
		xhr.send();
	});
}
</script>
