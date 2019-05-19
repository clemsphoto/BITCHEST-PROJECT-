@extends('layouts.app')

@section('content')


<!-- on affiche la page "portefeuille" du client avec son solde en euros -->
    
    <h1 class="page-header">Dashboard CLIENT</h1>

    @include('layouts.errors')

    <h2 class="sub-header">Mon portefeuille <span class="solde">Mon solde: <strong>{{$wallet->solde_euros}}€</strong></span></h2>
    <div class="table-responsive">

        <table class="table table-striped">
            <thead>
            <tr>
                
                <th>Nom de la crypto monnaie</th>
                <th>Quantité</th>
                <th>Valeur initiale de la crypto monnaie</th>
                <th>Valeur du lot</th>

                <th>Action</th>

            </tr>
            </thead>
            <tbody>
            
            @foreach($spends as $spend)

                <tr>
                
                    <td>{{ $spend->crypto_currencies->name}}</td>
                    <td>{{ $spend->quantité}}</td>
                    <td>{{ $spend->crypto_currencies->valeur_init}}€</td>
                    <td>{{ $spend->valeur_euros }}</td>
                    <td>
                        <a href="/wallet/sell/{{$spend->id}}" type="button" class="btn btn-danger">vendre</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
