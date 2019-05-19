@extends('layouts.app')


<!-- 
DETAIL DU COMPTE de l'ADMIN
-->

@section('content')
    <h2>Détail du compte client</h2>
    <hr>
    
    <div class="account">
        <h3>Informations personnelles</h3>
        {{--{{ dump($user) }}--}}
        <ul>
            <li>
                <strong>Nom:</strong>{{ $user[0]->name }}
            </li>

            <li>
                <strong>Email:</strong>{{ $user[0]->email }}
            </li>
            
            <li>
                <strong>Role:</strong>{{ $user[0]->role }}
            </li>
        </ul>

        <hr>

        @if( $user[0]->role == 'client' )
        <h3>Détail  du portefeuille client</h3>
        {{--{{dump($wallet)}}--}}
        @endif
       
    </div>

    <form action="/clients/create" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Nom:</label>
        <input type="text" class="form-control" name="name" value="">
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" name="email" value="">
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" value="">
    </div>

    <div class="form-group">
        <label for="password">Role:</label>
       
        <select class="form-control" name="role">
          
            @foreach($roles as $index => $role)
            <option value="{{$role}}" name="role">{{ $role }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Enregister">
    </form>
@endsection