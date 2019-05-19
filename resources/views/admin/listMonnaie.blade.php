@extends('layouts.app')

@section('content')


<!--  DETAILS DES CRYPTO MONNAIE du dashboard ADMIN -->

    @include('layouts.errors')

    <h1 class="page-header">Dashboard ADMIN</h1>

    <h2 class="sub-header">Cryptos-monnaies </h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Nom de la crypto-monnaie</th>
                <th>Valeur actuelle de la monnaie</th>
                <th>Taux actuel de la monnaie</th>

            </tr>
            </thead>
            <tbody>
            @foreach($cryptos as $crypto)

                    <tr>
                    <td>#</td>
                    <td>{{ $crypto->name}}</td>
                    <td>{{ $spends[$crypto->id -1]->valeur_euros}}€</td>
                    <td>{{ $crypto->getCoursActuel()->taux }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
