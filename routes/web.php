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
Route::group(['middleware => auth'],function(){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('categories','categoryController');
    Route::resource('tags','TagController');
    Route::resource('posts','PostController');
    Route::get('/trashed','PostController@trash')->name('trash.index');
    Route::get('/restore/{id}','PostController@restore')->name('restore');
});

