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

Route::get('/','PublicController@index');
Route::post('/','PublicController@contact');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('auth')->group(function () {
	Route::get('general','AuthControl@generalIndex');
	Route::post('general','AuthControl@saveGeneralConf');
	Route::get('servicios','ServiceController@index');
	Route::post('servicios','ServiceController@store');
	Route::get('servicios/new','ServiceController@create');
	Route::get('servicios/{id}/edit','ServiceController@edit');
	Route::put('servicios/{id}','ServiceController@update');
	Route::get('imagenes','ImageController@index');
	Route::post('imagenes','ImageController@store');
	Route::get('imagenes/new','ImageController@create');
	Route::get('imagenes/{id}/edit','ImageController@edit');
	Route::put('imagenes/{id}','ImageController@update');
	Route::delete('imagenes/{id}','ImageController@destroy');
});