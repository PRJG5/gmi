


@if ($cards->isEmpty())
    <p>Pas de fiche</p>
@else
        
<table class="table">
<thead>
    <tr>
        <th scope="col" class="order-1">Vedette</th>
        <th scope="col">Langue</th>
        <th scope="col">Definition</th>
        <th scope="col">Votes</th>
        <th scope="col">Validation</th>
      <th scope="col"></th>
    </tr>
  </thead>
    @foreach ($cards as $card)

  <tbody>
    <tr>
        <th scope="row">{{$card->heading}}</th>
        <td>{{$card->getLanguage()}}</td>
        <td>{{$card->getDefinition()}}</td>
        <td>{{$card->count_vote}}</td>
        <td>
            @if(isset($card->validation_id))
                <i class="fa fa-check text-success"></i>
            @else
                <i class="fa fa-times text-danger"></i>
            @endif
        </td>
      <td>
          <form action='/cards/{{$card->id}}' method="get">
              @csrf
              <button type="submit" class="btn btn-primary">Show</button>
          </form>
      </td>
    </tr>
    
  </tbody>

    @endforeach

    </table>
@endif

<div class="row">
    <form action={{route('cards.create')}} method="get">
        @csrf
        <button type="submit" class="btn btn-primary">add Card</button>
    </form>

</div>
    
