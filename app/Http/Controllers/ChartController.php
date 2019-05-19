<?php

namespace App\Http\Controllers;

use App\Rate;
use App\CryptoCurrency;
use App\Wallet;
use App\Spend;
use App\User;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChartController extends Controller
{

    /*******************************************  controler pour afficher les graphiques  ***********************************/

    public function index()
    {

        $currentUser = Auth::user();
        $wallet = Wallet::find($currentUser->id);
        $cryptos = CryptoCurrency::all();
        $valeurId = 1;
        $rate = Rate::where('crypto_currency_id', '=', $valeurId)->get();

        $dataCrypto = [];
        $date = [];

        for($i = 0; $i < count($rate); $i++){
            array_push($dataCrypto, $rate[$i]->taux);
        }

        for($j = 0; $j < count($rate); $j++){
            array_push($date, $rate[$j]->date);
        }


        $cryptoValue = Crypto::find($valeurId);
        $chart = Charts::create('line', 'highcharts')
            ->Title('graphique')
            ->Labels($date)
            ->Values($dataCrypto)
            ->Dimensions(1000,500)
            ->Responsive(false);
        return view('client.chart',compact('chart','cryptoValue','valeurId', 'rate', 'currentUser','cryptos', 'wallet'));

    }

    public function showCrypto(Crypto $crypto)
    {
        $currentUser = Auth::user();
        $wallet = Wallet::find($currentUser->id);
        $cryptos = CryptoCurrency::all();
        $valeurId = $crypto->id;
        $rate = Rate::where('crypto_currency_id', '=', $valeurId)->get();

        $dataCrypto = [];
        $date = [];

        for($i = 0; $i < count($rate); $i++){
            array_push($dataCrypto, $rate[$i]->taux);
        }

        for($j = 0; $j < count($rate); $j++){
            array_push($date, $rate[$j]->date);
        }


        $cryptoValue = Crypto::find($valeurId);
        $chart = Charts::create('line', 'highcharts')
            ->Title('graphique')
            ->Labels($date)
            ->Values($dataCrypto)
            ->Dimensions(1000,500)
            ->Responsive(false);
        return view('client.chart',compact('chart','cryptoValue','rate','valeurId', 'currentUser','cryptos', 'wallet'));

    }

    public function buyCrypto(Crypto $crypto)
    {
        $currentUser = Auth::user();
        return view('client.buy',compact('currentUser','crypto'));
    }

    public function confirmBuyCrypto(Request $request, Crypto $crypto)
    {
        $today = Carbon::today();
        $currentUser = Auth::user();
        //$date = new DateTime();
       
        $current_cours = Rate::where('crypto_currency_id', '=', $crypto->id)
                ->where('date', '=', $today)->get();

        //dd($current_cours);

        $valeur_euros = $request->quantite * $current_cours[0]->taux;
        dump($valeur_euros);
        //dd($current_cours);

       
        /*
        $request= [
            'crypto_currency_id' => $crypto->id,
            'users_id' => $currentUser->id,
            'date_achat' => $today->format('Y-m-d'),
            'quantité' => $request->quantite,
            'valeur_euros' => $valeur_euros,
            'rate_id' => $crypto->id
        ];*/

        $request->request->add([
            'crypto_currency_id' => $crypto->id,
            'users_id' => $currentUser->id,
            'date_achat' => $today->format('Y-m-d'),
            'valeur_euros' => $valeur_euros,
            'rate_id' => $current_cours[0]->id,
            'quantité' => $request->quantite,
        ]);
        //dd($request);
        request()->validate([
            'crypto_currency_id' => 'required',
            'users_id' => 'required',
            'date_achat' => 'required',
            'quantité' => 'required',
            'valeur_euros' => 'required',
            'rate_id' => 'required',
        ]);
        //dd($request);

        Spend::create($request->all());

        return redirect()->route('listMonnaie')->with('Success','Votre achat a bien été effectué');
    }
    
}
