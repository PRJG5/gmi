@if ($cards->isEmpty())
<p>Pas de fiche</p>
@else

<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th th-sm>Vedette</th>
      <th th-sm>Langue</th>
      <th th-sm>Definition</th>
      <th th-sm>Votes</th>
      <th th-sm>Validation</th>
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
       
            @if(isset($card->validation_id))
                <i class="fas fa-check text-success"></i>
            @else
                <i class="fas fa-times text-danger"></i>
            @endif
        </td>
        
      <td> 
        <form action='/cards/{{$card->id}}' method="get">
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