


@if ($cards->isEmpty())
    <p>Pas de fiche</p>
@else
<table class="table">
<thead>
    <tr>
      <th scope="col" class="order-1">Vedette</th>
      <th scope="col">Langue</th>
      <th scope="col">Definition</th>
      <th scope="col"></th>
    </tr>
  </thead>
    @foreach ($cards as $card)
<<<<<<< HEAD
    <!-- ICI LISTE DES CARTES-->
        <div class="row">
            <div class="col-md-4">{{$card->heading}}</div>
            <form action='/card/{{$card->id}}' method="get">
                @csrf
                <button type="submit" class="btn btn-primary" style="padding-top=10px">Show</button>
            </form>
        </div>
=======
        
  
  <tbody>
    <tr>
      <th scope="row">{{$card->heading}}</th>
      <td>{{$card->getLanguage()}}</td>
      <td>{{$card->getDefinition()}}</td>
      <td> <button type="submit" class="btn btn-primary">Show</button></td>
    </tr>
    
  </tbody>

>>>>>>> master
    @endforeach

    </table>
@endif

<div class="row">
    <form action={{route('cards.create')}} method="get">
        @csrf
        <button type="submit" class="btn btn-primary">add Card</button>
    </form>
</div>
    
