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

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');


Auth::routes();

Route::get('/home', 'BackController@index')->name('dashboard')->middleware('auth');

Route::get('/listMonnaie', 'BackController@listMonnaie')->name('listMonnaie')->middleware('auth');
Route::get('/listCrypto', 'BackController@listMonnaieAdmin')->name('listCrypto')->middleware('auth');


Route::get('/wallet', 'SpendController@index')->name('wallet')->middleware('auth');

Route::get('/wallet/sell/{spend}', 'SpendController@displaySpend')->name('wallet-sell')->middleware('auth');



Route::get('/chart', 'ChartController@index')->name('chart')->middleware('auth');
Route::get('/chart/{crypto}', 'ChartController@showCrypto')->name('chart')->middleware('auth');

Route::get('/chart/buy/{crypto}', 'SpendController@buyCrypto')->name('buy')->middleware('auth');
Route::post('/chart/buy/{crypto}', 'SpendController@confirmBuyCrypto')->name('confirm-buy')->middleware('auth');


Route::get('/account', 'BackController@showaccount')->name('account')->middleware('auth');
Route::patch('/account/update/{user}', 'BackController@update')->name('update')->middleware('auth');

Route::get('/clients', 'BackController@showclients')->name('clients')->middleware('auth');
Route::get('/clients/{user}/detail', 'ClientController@show')->name('show')->middleware('auth');
Route::get('/clients/{user}/delete', 'ClientController@destroy')->name('delete')->middleware('auth');
Route::get('/clients/{user}/modify', 'ClientController@index')->name('modify')->middleware('auth');

Route::patch('/clients/update/{user}', 'ClientController@update')->name('update')->middleware('auth');

Route::get('/clients/create', 'ClientController@create')->name('createclients')->middleware('auth');
Route::post('/clients/create', 'ClientController@store')->name('store')->middleware('auth');


Route::get('/historique', 'SpendController@showHistorique')->name('wallet')->middleware('auth');

