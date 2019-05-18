<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public $table = "rates";
    protected $fillable = [
        'crypto_currency_id',
        'date',
        'taux'
    ];

    public function crypto_currencies()
    {
        return $this->belongsTo(CryptoCurrency::class);
    }
}
