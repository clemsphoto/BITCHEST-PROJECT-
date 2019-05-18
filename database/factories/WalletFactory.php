<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

/* use App\Wallet; */
use Faker\Generator as Faker;

$factory->define(App\Wallet::class, function (Faker $faker) {
    return [
        'users_id' => $faker->numberBetween(1, 5),
        'crypto_currency_id' => $faker->numberBetween(1, 10),
        'solde_euros' => $faker->numberBetween(1, 500)
    ];
});