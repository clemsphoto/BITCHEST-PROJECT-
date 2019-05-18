@extends('layouts.app')

@section('content')

<h1>Modification du compte</h1>

<hr>

<form action="/clients/update/{{$user->id}}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="form-group">
        <label for="name">Nom:</label>
        <input type="text" class="form-control" name="name" value="{{$user->name}}">
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" name="email" value="{{$user->email}}">
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" value="{{$user->password}}::hach">
    </div>

    <div class="form-group">
        <label for="role">Role:</label>
       
        <select class="form-control" name="role">
          
            @foreach($roles as $index => $role)
            <option value="{{$role}}" name="role">{{ $role }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button class="btn btn-primary">Mettre à jour</button>
    </div>
</form>

@endsection