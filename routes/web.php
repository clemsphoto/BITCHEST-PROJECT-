<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Pour la route il suffit de désigner le nom du contrôleur et le nom de la méthode séparés par @. */

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');


Auth::routes();

Route::get('/home', 'BackController@index')->name('dashboard')->middleware('auth'); // route pour zfficher le dashbord

Route::get('/listMonnaie', 'BackController@listMonnaie')->name('listMonnaie')->middleware('auth'); // route pour afficher la liste des monnaie
Route::get('/listCrypto', 'BackController@listMonnaieAdmin')->name('listCrypto')->middleware('auth');


Route::get('/wallet', 'SpendController@index')->name('wallet')->middleware('auth'); // route pour afficher les depenses 

Route::get('/wallet/sell/{spend}', 'SpendController@displaySpend')->name('wallet-sell')->middleware('auth'); 



Route::get('/chart', 'ChartController@index')->name('chart')->middleware('auth'); // route pour afficher les graphiques 
Route::get('/chart/{crypto}', 'ChartController@showCrypto')->name('chart')->middleware('auth');

Route::get('/chart/buy/{crypto}', 'SpendController@buyCrypto')->name('buy')->middleware('auth'); // route pour acheter des crypto monnaies
Route::post('/chart/buy/{crypto}', 'SpendController@confirmBuyCrypto')->name('confirm-buy')->middleware('auth'); // route pour confirmer l'achat 


Route::get('/account', 'BackController@showaccount')->name('account')->middleware('auth'); // route pour les compte cleint
Route::patch('/account/update/{user}', 'BackController@update')->name('update')->middleware('auth');

Route::get('/clients', 'BackController@showclients')->name('clients')->middleware('auth'); // route pour afficher le client
Route::get('/clients/{user}/detail', 'ClientController@show')->name('show')->middleware('auth'); // route pour montrer la fiche client
Route::get('/clients/{user}/delete', 'ClientController@destroy')->name('delete')->middleware('auth'); // route pour supprimer un client 
Route::get('/clients/{user}/modify', 'ClientController@index')->name('modify')->middleware('auth'); // route pour moddifier un client

Route::patch('/clients/update/{user}', 'ClientController@update')->name('update')->middleware('auth');

Route::get('/clients/create', 'ClientController@create')->name('createclients')->middleware('auth'); // route pour creer un client 
Route::post('/clients/create', 'ClientController@store')->name('store')->middleware('auth');


Route::get('/historique', 'SpendController@showHistorique')->name('wallet')->middleware('auth'); // route pour afficher les portemonnaie

