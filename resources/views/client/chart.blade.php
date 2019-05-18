@extends('layouts.app')

@section('content')

    <h1 class="page-header">Dashboard CLIENT</h1>


    <h2 class="sub-header">Graphique <span class="solde">Mon solde: <strong>{{$wallet->sold_euros}} €</strong></span></h2>

                    <div class="panel-heading" style="font-weight: bold; color: rgb(42, 136, 189);">Résumé des dépenses
                       <span class="listDeroulanteCrypto"> <select class="selectpicker ">

                            @foreach($cryptos as $crypto)

                            <option value="{{$crypto->id}}" @if($crypto->id == $valeurId)
                            {
                                    selected = "selected"
                            }
                            @endif

                            >{{$crypto->name}}
                            </option>
                            @endforeach
                        </select>
                           </span>
                    </div>
                    <div class="panel-body">
                        {!! $chart->html() !!}
                    </div>

    {!! Charts::scripts() !!}
    {!! $chart->script() !!}

    <script>
        $( document ).ready(function() {
            // var address = 'chart/';
            $( ".selectpicker" ).change(function() {

               var address = $(this).val();
                console.log(address);
                window.location = (address);
            });
        });
    </script>
@endsection


