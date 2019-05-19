<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /*************************************** MODEL POUR LES UTILISATEUR  ******************************/



    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ // on cache le passeword
        'password', 'remember_token',
    ];

    public function spends()
    {

        return $this->hasMany(Spend::class);
    }


    public function wallets()
    {
        return $this->hasOne(Wallet::class);
    }


    public function rate()
    {
        return $this->hasOne(Rate::class);
    }
}
