<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//Home Pages etc.
Route::get('/', 'HomeController@index');
Route::get('/index', 'HomeController@index');
Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');


// Pages about houses.
Route::resource('for_{type}', 'HousesController', ['parameters' => ['for_{type}' => 'id']]);

// Pages about users.
Route::get('/user/transaction', 'UsersController@transaction');
Route::post('/user/upgraderequest', 'UsersController@upgradeRequest');
Route::get('/user/auth', 'UsersController@auth');
Route::post('/user/houseauth', 'UsersController@houseAuth');
Route::post('/user/buyerauth', 'UsersController@buyerAuth');
Route::get('/user/{id}', 'UsersController@show');

// Pages about transactions.
Route::get('/transaction', 'TransactionsController@show');
Route::post('/transaction', 'TransactionsController@store');
Route::post('/transaction/update', 'TransactionsController@update');

Route::get('/message', 'MessageController@index');
Route::auth();


Route::get('{foo}/{foo1?}/{foo2?}/{foo3?}/{foo4?}', function() {
	flash()->warning('The page does not exist!',' ');
	return redirect()->back();
});