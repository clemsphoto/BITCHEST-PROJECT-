@extends('layouts.app')


 <!-- CREATION D'UN CLIENT  -->

 
@section('content')
    <h2>Création d'un client</h2>
    <hr>
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