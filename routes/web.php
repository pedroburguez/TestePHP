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

Route::get('/login', function () {
    return view('login');
});

Auth::routes();
Route::get('/', function(){
  return redirect('login');
});
Route::get('/home', 'MoviesController@index')->name('home');
Route::get('/favorite-movies', 'MoviesController@showFavoriteMovies')->name('favorite-movies');
Route::post('/add-favorite', 'MoviesController@addFavorite')->name('add-favorite');
Route::delete('/delete-favorite-ajax', 'MoviesController@deleteFavoriteAjax')->name('delete-favorite-ajax');
