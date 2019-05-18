<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id'); // creation de la table etrangere (_id)
            $table->unsignedInteger('crypto_currency_id');
            $table->decimal('solde_euros', 6, 2);
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade'); // liaison clé etrangere qui va appeler le champs qui correspond, ce champs se trouve dans une table et dans cette table on trouve un champs.
            $table->foreign('crypto_currency_id')->references('id')->on('crypto_currencies'); // on rappelle  la table  crypto_curriencies
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
