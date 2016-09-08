<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return redirect('/');
});

Route::get('/article', 'ArticleController@index');
Route::get('/article/{id}', 'ArticleController@show');
Route::post('/article', 'ArticleController@store');
Route::put('/article', 'ArticleController@update');
Route::delete('/article/{id}', 'ArticleController@destroy');

Route::get('/category', 'CategoryController@index');
Route::get('/category/{id}', 'CategoryController@show');
Route::post('/category', 'CategoryController@store');
Route::put('/category', 'CategoryController@update');
Route::delete('/category/{id}', 'CategoryController@destroy');

Route::auth();
