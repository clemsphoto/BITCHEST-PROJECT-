@extends('layouts.app')


<!--   PAGE pour pouvoir acheter une crypto monnaie par le client -->


@section('content')
    @include('layouts.errors')

    @if(Session::has('flashMessage'))
        <div class="alert">
        <p>{{Session::get('flashMessage')}}</p>
        </div>
    @endif

    <h1 class="page-header">Acheter une crypto monnaie</h1>
    
    <p><strong>Crypto : </strong>{{$crypto->name}}</p>

    <form action="/chart/buy/{{$crypto->id}}" method="POST">
    {{csrf_field()}}

    <div class="form-group">
        <label for="quantite">Quantité:</label>
        <input type="text" name="quantite" required>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Confirmer">
    </div>

    </form>

@endsection


