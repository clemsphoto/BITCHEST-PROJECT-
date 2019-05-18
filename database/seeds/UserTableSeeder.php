<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
            factory(App\User::class, 8)->create()->each(function ($user){

                $faker = Faker\Factory::create();

                [
                    "name" => $faker->name,
                    "email" => $faker->email,
                    "password" => bcrypt('secret'),
                ];
            });


            DB::Table('users')->insert(array(
                [
                    'name' => 'admin',
                    'email' => 'admin@admin.com',
                    'password' => Hash::make('admin'),
                    'role' => 'admin'
                ],
                [
                    'name' => 'client',
                    'email' => 'client@client.com',
                    'password' => Hash::make('client'),
                    'role' => 'client'
                ],
            ));
        
    }
}