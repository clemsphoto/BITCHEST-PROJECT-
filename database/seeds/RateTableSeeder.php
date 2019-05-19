<?php

use Illuminate\Database\Seeder;

class RateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        

    /**
     * Renvoie la valeur de mise sur le marché de la crypto monnaie
     * @param $cryptoname {string} Le nom de la crypto monnaie
     */
    function getFirstCotation($cryptoname){
        return ord(substr($cryptoname,0,1)) + rand(0, 10);
    }    

    /**
     * Renvoie la variation de cotation de la crypto monnaie sur un jour
     * @param $cryptoname {string} Le nom de la crypto monnaie
     */
        function getCotationFor($cryptoname){
            return ((rand(0, 99)>40) ? 1 : -1) * ((rand(0, 99)>49) ? ord(substr($cryptoname,0,1)) : ord(substr($cryptoname,-1))) * (rand(1,10) * .01);
        }
        $cryptos = App\CryptoCurrency::all();

        foreach ($cryptos as $crypto)
        {
            $crypto_base = $crypto->valeur_init;

            for ($j = 0; $j < 30; $j++)
            {
                $date = new DateTime();

                $rate = factory(App\Rate::class, 1)->create();
                $cryptoname = $crypto->name;
                $crypto_base +=  ((rand(0, 99)>40) ? 1 : -1) * ((rand(0, 99)>49) ? ord(substr($cryptoname,0,1)) : ord(substr($cryptoname,-1))) * (rand(1,10) * .01);

                if ($crypto_base < 0 )  $crypto_base = 0;

                $rate[0]->taux = $crypto_base;
                $rate[0]->date = $date->modify('-'.(29 - $j).'days')->format('Y-m-d');
                $crypto->rates()->save($rate[0]);

                }
        };
    }

}