<?php

use Illuminate\Database\Seeder;

class CryptoCurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::Table('crypto_currencies')->insert(array(
            [
                'name' => 'Bitcoin',
                'valeur_init' => ord(substr('Bitcoin',0,1)) + rand(0, 10) // dans un ordre 
            ],
            [
                'name' => 'Ethereum',
                'valeur_init' => ord(substr('Ethereum',0,1)) + rand(0, 10)
            ],
            [
                'name' => 'Ripple',
                'valeur_init' => ord(substr('Ripple',0,1)) + rand(0, 10)
            ],
            [
                'name' => 'Bitcoin Cash',
                'valeur_init' => ord(substr('Bitcoin Cash',0,1)) + rand(0, 10)
            ],
            [
                'name' => 'Cardano',
                'valeur_init' => ord(substr('Cardano',0,1)) + rand(0, 10)
            ],
            [
                'name' => 'Litecoin',
                'valeur_init' => ord(substr('Litecoin',0,1)) + rand(0, 10)
            ],
            [
                'name' => 'NEM',
                'valeur_init' => ord(substr('NEM',0,1)) + rand(0, 10)
            ],
            [
                'name' => 'Stellar',
                'valeur_init' => ord(substr('Stellar',0,1)) + rand(0, 10)
            ],
            [
                'name' => 'IOTA',
                'valeur_init' => ord(substr('IOTA',0,1)) + rand(0, 10)
            ],
            [
                'name' => 'Dash',
                'valeur_init' => ord(substr('Dash',0,1)) + rand(0, 10)
            ],

        ));
    }
}