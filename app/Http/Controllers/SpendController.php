<?php

namespace App\Http\Controllers;

use App\Rate;
use App\CryptoCurrency;
use App\Wallet;
use App\Spend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SpendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = Auth::user();
        $spends = Spend::where('users_id', '=' , $currentUser->id)
        ->where('active', '=', 1)->get();        
        $wallet = Wallet::find($currentUser->id);
        //$portefeuilleCryptos = Portefeuille::find($currentUser->id);
        $cryptos = CryptoCurrency::all();
        $rates = Rate::all();

        return view('client.wallet', compact('currentUser','spends','wallet', 'cryptos', 'rates'));

    }
    public function showHistorique() {

        $currentUser = Auth::user();
        $spends = Spend::where('users_id', '=' , $currentUser->id)->orderBy('date_achat', 'desc')->get();
        $achats = Spend::where('users_id', '=' , $currentUser->id)
        ->where('active', '=', 1)->orderBy('date_achat', 'desc')->get();

        $ventes = Spend::where('users_id', '=' , $currentUser->id)
        ->where('active', '=', 0)->orderBy('date_achat', 'desc')->get();

        $wallet = Wallet::find($currentUser->id);
        $cryptos = CryptoCurrency::all();
        $rates = Rate::all();
        $status = ['Vendue','Validée'];

        return view('client.historique', compact('currentUser','spends','wallet', 'cryptos', 'rates', 'status', 'achats', 'ventes'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function show(Spend $spend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function edit(Spend $spend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spend $spend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spend  $spend
     * @return \Illuminate\Http\Response
     */

    public function displaySpend(Spend $spend)
    {
        $valeur_euros = $spend->valeur_euros;
        
        $wallet = Wallet::find($spend->users_id); // a voir pour le S a la fin de user_id
        $wallet->solde_euros += $valeur_euros;
        $wallet->save();

        $spend->active = 0;
        $spend->save();

        //Spend::destroy($spend->id);
        return back()->with('successMessage','Votre vente a bien été effectuée. Merci !');
    }
    
    public function destroy(Spend $spend)
    {
        $valeur_euros = $spend->valeur_euros;
        
        $wallet = Wallet::find($spend->users_id); // a voir pour le S a la fin de user_id
        $wallet->solde_euros += $valeur_euros;
        $wallet->save();


        Spend::destroy($spend->id);
        return redirect()->route('wallet')
        ->with('success','Votre vente a bien été effectuée. Merci !');
    }

    public function buyCrypto(Crypto $crypto)
    {
        $currentUser = Auth::user();

        return view('client.buy', compact('currentUser','crypto'));
    }

    public function confirmBuyCrypto(Request $request, Crypto $crypto)
    {
        $today = Carbon::today();
        $currentUser = Auth::user();

        $wallet = Wallet::find($currentUser->id);



        $current_cours = Rate::where('crypto_currency_id', '=', $crypto->id)
                ->where('date', '=', $today)->get();
        

        $valeur_euros = $request->quantite * $current_cours[0]->taux;
        
        if( $wallet->solde_euros - $valeur_euros < 0){
            return back()->with('errorMessage','Votre solde \' est pas suffisant pour effectuer cet achat');
        }


        $request->request->add([
            'crypto_currency_id' => $crypto->id,
            'users_id' => $currentUser->id,
            'date_achat' => $today->format('Y-m-d'),
            'valeur_euros' => $valeur_euros,
            'active' => 1,
            'rate_id' => $current_cours[0]->id,
            'quantité' => $request->quantite,
        ]);
    
        request()->validate([
            'crypto_currency_id' => 'required',
            'users_id' => 'required',
            'date_achat' => 'required',
            'quantité' => 'required',
            'valeur_euros' => 'required',
            'rate_id' => 'required',
        ]);
        
        $wallet->solde_euros -= $valeur_euros;
        $wallet->save();
        
        Spend::create($request->all());

        return redirect()->route('listMonnaie')->with('successMessage','Votre achat a bien été effectué');
    }
}