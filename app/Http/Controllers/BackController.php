<?php

namespace App\Http\Controllers;

use App\Rate;
use App\CryptoCurrency;
use App\Wallet;
use App\Spend;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BackController extends Controller


/***********************************  Controler pour afficher le dashboard *****************************/


{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = Auth::user();
        $spends = Spend::where('users_id', '=' , $currentUser->id)->get();
        $cryptos = CryptoCurrency::all();
        $rates = Rate::all();
        $wallet = Wallet::find($currentUser->id);


        if($currentUser->role == 'admin'){
            return view('admin.home', compact('currentUser'));
        }else{
            return view('client.home', compact('currentUser','spends','wallet', 'cryptos', 'rates'));
        }
    }

    public function showaccount()
    {
        $roles = ['admin','client'];
        $currentUser = Auth::user();
        return view('admin.account', compact('currentUser','roles'));
    }

    public function showclients()
    {
        $users = DB::table('users');
        $currentUser = Auth::user();
        $allusers = User::all();
        $clients = User::all()->where('role', '=', 'client');
        $admins = User::all()->where('role', '=', 'admin');

        //dd($clients);
        return view('admin.list-clients', compact('currentUser', 'allusers'));
    }

    public function update(Request $request, User $user)
    {
        //dd($request);
        request()->validate([  // la validation dans les controller
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $request->merge([
            'password' => bcrypt($request->get('password')), // Helper function for Hash::make
        ]);

        $user->update($request->all());
        return redirect()->route('account')
                        ->with('success','Votre profil a bien été mis à jour');
    }

    public function listMonnaie()
    {
        $currentUser = Auth::user();
        $cryptos = CryptoCurrency::get();
        $spends = Spend::all();
        $rates = Rate::all();
        $wallet = Wallet::find($currentUser->id);
        $today = Carbon::today();
        $progression = [];

        for($i = 0; $i < count($cryptos) ; $i++ ){

            //dump($cryptos[$i]->id);
            $current_cours = Rate::where('crypto_currency_id', '=', $cryptos[$i]->id)
            ->where('date', '=', $today)->get();

            $current_coursN1 = Rate::where('crypto_currency_id', '=', $cryptos[$i]->id)
            ->where('id', '=', $current_cours[0]->id - 1)->get();
            $valeur_taux = $current_cours[0]->taux - $current_coursN1[0]->taux;
            //dump($current_cours);
            //dump($current_coursN1);
            //dump($valeur_taux);
            array_push($progression, $valeur_taux);
        }
        //dump($progression);
        //dd($cryptos);
        return view('client.listMonnaie', compact('cryptos', 'spends','wallet', 'rates', 'progression' , 'currentUser'));



    }
    public function listMonnaieAdmin()
    {
        $currentUser = Auth::user();
        $cryptos = CryptoCurrency::get();
        $spends = Spend::all();
        $Rates = Rate::all();
        $wallet = Wallet::find($currentUser->id);


        return view('admin.listMonnaie', compact('cryptos', 'spends','wallet', 'rates', 'currentUser'));
    }

    public function graphic()
    {
        $currentUser = Auth::user();
        $cryptos = CryptoCurrency::all();
        $rates = Rate::all();
        $wallet = Wallet::find($currentUser->id);

        return view('client.graphic', compact('cryptos','rate','wallet', 'currentUser'));

    }
}