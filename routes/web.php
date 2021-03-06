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


Route::get('/','HomeController@index');

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

Route::get('/miniatura/{filename}',array(
    'as' => 'imageVideo',
    'uses' => 'VideoController@getImage'
));

Route::get('/video/{video_id}',array(
    'as' => 'detailVideo',
    'uses' => 'VideoController@getVideoDetail'

));

Route::get('/video-file/{filename}',array(
    'as' => 'fileVideo',
    'uses' => 'VideoController@getVideo'
));

//Comentarios

Route::post('/comment',array(
    'as' => 'comment',
    'middleware' => 'auth',
    'uses' => 'CommentController@store'
));

Route::get('/delete-comment/{comment_id}',array(
    'as' => 'commentDelete',
    'middleware' => 'auth',
    'uses' => 'CommentController@delete'
));
Route::get('/delete-video/{video_id}',array(
    'as' => 'videoDelete',
    'middleware' => 'auth',
    'uses' => 'VideoController@delete'
));
Route::get('/edit-video/{video_id}',array(
    'as' => 'videoEdit',
    'middleware' => 'auth',
    'uses' => 'VideoController@edit'
));
Route::post('/update-video/{video_id}',array(
    'as' => 'videoUpdate',
    'middleware' => 'auth',
    'uses' => 'VideoController@update'
));