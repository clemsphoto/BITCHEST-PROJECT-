@extends ('layouts.app')

@section('content')

    <h2>Liste des Clients</h2>

    <hr>

    <table class="table table-striped">
  <thead class="thead-light">
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>

  <tbody>
    @foreach($allusers as $client)
    <tr>
        <th scope="col">{{$client->name}}</th>
        <th scope="col">{{$client->role}}</th>
        <th scope="col">
            <a href="clients/{{$client->id}}/detail" class="btn btn-danger">Voir</a>
            <a href="clients/{{$client->id}}/modify" class="btn btn-danger">Modifier</a>
            <a href="clients/{{$client->id}}/delete" class="btn btn-danger">Supprimer</a>
        </th>
    </tr>
    @endforeach
  </tbody>
  <tfooter>
    <tr>
      <th scope="col"><a href="clients/create" class="btn btn-success">Ajouter un client</a></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </tfooter>
</table>
@endsection