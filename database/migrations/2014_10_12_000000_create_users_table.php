<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()  // fonction qui va etre execute pour creer la table
    {

    /* Champs de la table en PHP */
    /* https://laravel.com/docs/5.5/migrations#creating-columns */
    /* Ici ce trouve le shcema de notre table ( structure) pour sa creation */
        
    Schema::create('users', function (Blueprint $table) { // Nous demandons la création de la table 'users'
        $table->increments('id'); // clé primaire -> Création d'un champ 'id' auto-incrémenté
        $table->string('name',100); //Varchar 100 -> Création d'un champ texte 'name' de 100 caractères
        $table->string('email',100)->unique();  // varchar 100 ->email
        $table->string('password',100);
        $table->enum('role',['admin', 'client']); // profile d'un utilisateur
        $table->rememberToken(); // texte de 100 caracteres qui servira pour l'authentification 
        $table->timestamps(); // timestamps Permet la creation de é colonne  created_at et updated_at TIMESTAMP equivalent columns.
        });
    }

    /**
     * Reverse the migrations.y
     *
     * @return void
     */
    public function down() // Fonction qui va etre executée pour supprimer la table 
    {
        Schema::dropIfExists('users');  // ici on gere la supp de la table
    }
    }

