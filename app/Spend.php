<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Spend extends Model
{
    protected $fillable = [
        'crypto_currency_id',
        'users_id',
        'date_achat',
        'quantité',
        'valeur_euros',
        'active',
        'rate_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function crypto_currencies()
    {

        return $this->belongsTo(CryptoCurrency::class);
    }

    public function rates()
    {
        return $this->belongsTo(Rate::class);
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
