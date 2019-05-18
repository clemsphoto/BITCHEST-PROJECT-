<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Wallet extends Model
{



    public $table = "wallets";

    protected $fillable = [ //= un attribut remplissable
        'users_id',
        'crypto_currency_id',
        'solde_euros'
    ];


    public function users() // A voir avec ou sans S // les utilisateurs
    {
        return $this->hasOne(User::class); //  hasOne: un utilisateur a un profil
    }


    public function crypto_currencies() // on fait appelle à toutes les monnaies
    {
        return $this->belongsTo(CryptoCurrency::class);// belongsTo = plusieurs monnaies apparteinnent à un utilisateur
    }



    public function getCoursActuel()
    {

        $cours =  DB::table('rates')
            ->select('taux')
            ->orderBy('date', 'desc')
            ->where('crypto_currency_id', '=', $this->id)
            ->first();
        return $cours;
    } 
}
