<?php


/* @var $factory \Illuminate\Database\Eloquent\Factory */

/* use App\Moniesrate; */
use Faker\Generator as Faker;

$factory->define(App\Rate::class, function (Faker $faker) {

    return [
        'crypto_currency_id' => $faker->numberBetween($min=1, $max=10),
        'date' => $faker->date('Y-m-d'),
        'taux' => 0

    ];
});