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


Route::get('/', function () {

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rutas del controlador de videos

Route::get('/crear-video',array(
    'as' => 'createVideo',
    'middleware' => 'auth',//Comprueba si estamos logeados
    'uses' => 'VideoController@createVideo'
));
Route::post('/guardar-video',array(
    'as' => 'saveVideo',
    'middleware' => 'auth',//Comprueba si estamos logeados
    'uses' => 'VideoController@saveVideo'
));