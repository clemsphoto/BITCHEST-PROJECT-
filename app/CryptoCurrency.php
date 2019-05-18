<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CryptoCurrency extends Model
{
    public $table = "crypto_currencies";

    protected $fillable = [
        'name',
        'valeur_init'
    ];

    public function spends()
    {
        return $this->hasOne(Spend::class);

    }
    public function rates()
    {
        return $this->hasMany(Rate::class);

    }
    public function getCoursActuel()
    {

        $cours = DB::table('rates')
            ->select('taux')
            ->orderBy('date', 'desc')
            ->where('crypto_currency_id', '=', $this->id)
            ->first();
        return $cours;
    } 
}
