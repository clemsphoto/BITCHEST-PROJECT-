<?php

namespace App\Http\Controllers;

use App\Rate;
use App\CryptoCurrency;
use App\Wallet;
use App\Spend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortefeuilleController extends Controller
{


    /*************************************************Controller pour afficher les portefeuilles  **********************/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = Auth::user();
        $spends = Spend::where('users_id', '=' , $currentUser->id)
        ->where('active', '=', '1')
        ->get();
        
        $wallet = Wallet::find($currentUser->id); // a voir pour mettre un S a $wallet 
        
        //$walletCryptos = Wallet::find($currentUser->id);
        $cryptos = CryptoCurrency::all();
        $rates = Rate::all();

        return view('client.wallet', compact('currentUser','spends','wallet', 'cryptos', 'rates'));

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
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //Spend::destroy($spend->id);
        return redirect()->route('wallet')
        ->with('success','Votre vente a bien été effectuée. Merci.');
    }
}
