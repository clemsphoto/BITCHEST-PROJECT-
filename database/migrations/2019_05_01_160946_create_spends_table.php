<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spends', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('crypto_currency_id');
            $table->unsignedInteger('rate_id');
            $table->date('date_achat');
            $table->decimal('quantité', 8, 2);
            $table->decimal('valeur_euros', 8, 2);
            $table->boolean('active');
            $table->foreign('rate_id')->references('id')->on('rates');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade'); // (cascade) on supprime en cascade celui qui est relié
            $table->foreign('crypto_currency_id')->references('id')->on('crypto_currencies');
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
        Schema::dropIfExists('spends');
    }
}
