@extends('layouts.app')

@section('content')

    
@include('layouts.errors')
    <h1 class="page-header">Dashboard CLIENT</h1>

    

    <h2 class="sub-header">Cryptos monnaies <span class="solde">Mon solde: <strong>€</strong></span></h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Nom de la crypto monnaie</th>
                <th>Valeur actuelle de la crypto-monnaie</th>
                <th>Taux actuel de la crypto-monnaie</th>
                <th>Progression</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
            @foreach($cryptos as $key => $crypto)

                    <tr>
                    <td>#</td>
                    <td>{{ $crypto->name}}</td>
                    <td>{{ $spends[$crypto->id -1]->valeur_euros}}€</td>
                    <td>{{ $crypto->getCoursActuel()->taux }}</td>
                    <td>
                        @if( $progression[$key] >= 0 )
                         <span class="text-success glyphicon glyphicon-chevron-up"></span><strong class="text-success">+{{ $progression[$key]}} €</strong>
                        
                    
                        @else
                        <span class="text-danger glyphicon glyphicon-chevron-down"></span><strong class="text-danger">{{ $progression[$key]}} €</strong>
                        @endif
                    </td>
                    <td>
                 

                        <a href="chart/buy/{{$crypto->id}}" class="btn btn-success">Acheter</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
