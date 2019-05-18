@extends('layouts.app')

@section('content')

    @include('layouts.errors')

    <h1 class="page-header">Historique CLIENT</h1>


    <h2 class="sub-header">Liste des transactions<span class="solde">Mon solde: <strong>{{$wallet->solde_euros}} €</strong></span></h2>
    <div class="table-responsive">
    
            <table class="table table-striped">
                <thead>
                <tr>
                    
                    <th>Nom de la crypto-monnaie</th>
                    <th>Quantité</th>
                    <th>Valeur initiale de la monnaie</th>
                    <th>Valeur du lot</th>
                    <th>Date de la transaction</th>
                    <th>Statut transaction</th>
      
    
                </tr>
                </thead>
                <tbody>
                
                @foreach($spends as $spend)
    
                    <tr>
                    
                        <td>{{ $spend->crypto_currencies->name}}</td>
                        <td>{{ $spend->quantité}}</td>
                        <td>{{ $spend->crypto_currencies->valeur_init}}€</td>
                        <td>{{ $spend->valeur_euros }}</td>
                        <td>{{ $spend->date_achat }}</td>
                        <td>@if($spend->active)
                                {{$status[1]}}
                            @else
                                {{$status[0]}}
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        <h2 class="sub-header">Liste des achats</h2>
            <div class="table-responsive">
    
            <table class="table table-striped">
                <thead>
                <tr>
                    
                    <th>Nom de la crypto monnaie</th>
                    <th>Quantité</th>
                    <th>Valeur initiale de la monnaie</th>
                    <th>Valeur du lot</th>
                    <th>Date de la transaction</th>
                    <th>Statut transaction</th>
    
                    
    
                </tr>
                </thead>
                <tbody>

                @foreach($achats as $achat)
    
                    <tr>
                    
                        <td>{{ $achat->crypto_currencies->name}}</td>
                        <td>{{ $achat->quantité}}</td>
                        <td>{{ $achat->crypto_currencies->valeur_init}}€</td>
                        <td>{{ $achat->valeur_euros }}</td>
                        <td>{{ $achat->date_achat }}</td>
                        <td>@if($achat->active)
                                {{$status[1]}}
                            @else
                                {{$status[0]}}
                            @endif
                        </td>
                    </tr>
                @endforeach

                
                </tbody>
            </table>
        </div>

        <h2 class="sub-header">Liste des ventes</h2>
            <div class="table-responsive">
    
            <table class="table table-striped">
                <thead>
                <tr>
                    
                    <th>Nom de la crypto monnaie</th>
                    <th>Quantité</th>
                    <th>Valeur initiale de la monnaie</th>
                    <th>Valeur du lot</th>
                    <th>Date de la transaction</th>
                    <th>Statut transaction</th>
    
                    
    
                </tr>
                </thead>
                <tbody>

                @foreach($ventes as $vente)
    
                    <tr>
                    
                        <td>{{ $vente->crypto_currencies->name}}</td>
                        <td>{{ $vente->quantité}}</td>
                        <td>{{ $vente->crypto_currencies->valeur_init}}€</td>
                        <td>{{ $vente->valeur_euros }}</td>
                        <td>{{ $vente->date_achat }}</td>
                        <td>@if($vente->active)
                                {{$status[1]}}
                            @else
                                {{$status[0]}}
                            @endif
                        </td>
                    </tr>
                @endforeach

                
                </tbody>
            </table>
        </div>

@endsection