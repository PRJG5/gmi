@if ($cards->isEmpty())
<p>Pas de fiche</p>
@else

<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead class="thead-dark">
    <tr>
      <th th-sm>Vedette</th>
      <th th-sm>Langue</th>
      <th th-sm>Definition</th>
      <th th-sm>Votes</th>
      <th th-sm>Montrez la carte</th>
    </tr>
  </thead>



  <tbody>
    @foreach ($cards as $card)
    <tr>
      <td>{{$card->heading}}</td>
      <td>{{$card->getLanguage()}}</td>
      <td>{{$card->getDefinition()}}</td>
      <td>{{$card->count_vote}}</td>
      <td>
        <form action='/card/{{$card->id}}' method="get">
          @csrf
          <button type="submit" class="btn btn-primary">Show</button>
        </form>
      </td>
    </tr>



    @endforeach
  </tbody>

</table>
@endif

<div class="row">
  <form action={{route('cards.create')}} method="get">
    @csrf
    <button type="submit" class="btn btn-primary">add Card</button>
  </form>

</div>

<script src="{{ asset('js/data.js') }}"></script>