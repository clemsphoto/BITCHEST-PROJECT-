@extends('layouts.app')

@section('content')

<!-- VUE DU DASHBOARD DU COMPTE ADMIN -->


  @include('layouts.errors')

  <h1 class="page-header">Dashboard ADMIN</h1>
  <h2>Liste des Clients</h2>

  <hr>

  <table class="table table-striped">
    <thead class="thead-light">
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Role</th>

    </tr>
    </thead>

    <tbody>
    @foreach($allusers as $client)
      <tr>
        <th scope="col">{{$client->name}}</th>
        <th scope="col">{{$client->role}}</th>
      </tr>
    @endforeach
    </tbody>
  </table>

  <h2 class="sub-header">Cryptos monnaies</h2>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>Nom de la crypto monnaie</th>
        <th>Valeur actuelle de la crypto monnaie</th>
        <th>Taux actuel de la crypto monnaie</th>

      </tr>
      </thead>
      <tbody>
      @foreach($cryptos as $crypto)

      <tr>
                <td><img src="/images/{{$crypto->name}}.png"></td>
                <td>{{ $crypto->name}}</td>
                <td>{{ $spends[$crypto->id -1]->valeur_euros}}€</td>
                <td>{{ $crypto->getCoursActuel()->taux}}</td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endsection