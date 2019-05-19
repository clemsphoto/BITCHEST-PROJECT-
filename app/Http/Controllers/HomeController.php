<?php







namespace App\Http\Controllers;

use App\Rate;
use App\CryptoCurrency;
use App\Wallet;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Spend;

class HomeController extends Controller
{

    /****************************     Controler pour afficher la vue generale     On recupere la vue Home      ****************/




    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $allusers = User::all();
        $spends = Spend::all();
        $cryptos = CryptoCurrency::all();
        $rates = Rate::all();
        $wallet = Wallet::find($currentUser->id);
        $today = Carbon::today(); // permet de generer les dates 
        $progression = [];
        //dd($spends);
        for($i = 0; $i < count($cryptos) ; $i++ ){

            $current_cours = Rate::where('crypto_currency_id', '=', $cryptos[$i]->id)
                ->where('date', '=', $today)->get();

            $current_coursN1 = Rate::where('crypto_currency_id', '=', $cryptos[$i]->id)
                ->where('id', '=', $current_cours[0]->id - 1)->get();
            $valeur_taux = $current_cours[0]->taux - $current_coursN1[0]->taux;

            array_push($progression, $valeur_taux);
        }

        if($currentUser->role == 'Admin'){
            return view('admin.home', compact('currentUser', 'cryptos', 'allusers','spends', 'rates', 'allUser'));
        }else{
            return view('client.home', compact('currentUser','spends','wallet', 'cryptos', 'rates', 'progression'));
        }
        
    }
}
