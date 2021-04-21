<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


//Veículos
Route::get('/vehicle/list', 'VehiclesController@index');
Route::get('/vehicle/create', 'VehiclesController@create');
Route::post('/vehicle/create', 'VehiclesController@store');
Route::post('/vehicle/delete/{id}', 'VehiclesController@destroy');
Route::get('/vehicle/edit/{id}', 'VehiclesController@edit');
Route::post('/vehicle/edit', 'VehiclesController@update');

//Usuários
Route::get('/user/list', 'UsersController@index');
Route::get('/user/create', 'UsersController@create');
Route::post('/user/create', 'UsersController@store');
Route::post('/user/delete/{id}', 'UsersController@destroy');
Route::get('/user/edit/{id}', 'UsersController@edit');
Route::post('/user/edit', 'UsersController@update');

//Agendamentos
Route::get('/booking/list/{id}', 'BookingController@index');
Route::post('/booking/create', 'BookingController@store');
Route::post('/booking/edit/{id}', 'BookingController@update');
Route::post('/booking/destroy/{id}', 'BookingController@destroy');


