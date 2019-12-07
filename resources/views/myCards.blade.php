@extends('layouts.app')

@section('content')
<h1> Mes Fiches </h1>

@include('card.index', $cards)

@endsection

@section('script')
<script>
  $(document).ready(function() {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
  });
</script>
@endsection
