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
Route::post('for_{type}/{id}/addphoto', 'HousesController@addPhoto');


// Pages about users.
Route::get('/user/transaction', 'UsersController@transaction');
Route::post('/user/upgraderequest', 'UsersController@upgradeRequest');
Route::get('user/house', 'UsersController@showHouse');
Route::get('/user/auth', 'UsersController@auth');
Route::post('/user/auth', 'UsersController@checkAuth');
Route::get('/user/{id}', 'UsersController@show');
Route::get('/user/{id}/edit', 'UsersController@edit');


// Pages about transactions.
Route::get('/transaction', 'TransactionsController@index');
Route::post('/transaction', 'TransactionsController@store');
Route::post('/transaction/update', 'TransactionsController@update');


// Pages about messages.
Route::get('/message', 'MessagesController@index');
Route::post('/message', 'MessagesController@store');
Route::get('/message/{id}', 'MessagesController@show');


// Auth pages.
Route::auth();


// Inexistent pages.
Route::get('{foo}/{foo1?}/{foo2?}/{foo3?}/{foo4?}', function() {
	flash()->warning('The page does not exist!',' ');
	return redirect()->back();
});