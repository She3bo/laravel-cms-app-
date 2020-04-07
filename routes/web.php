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

Route::get('/','WelcomeController@index');
Auth::routes();
Route::group(['middleware => auth'],function(){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('categories','categoryController');
    Route::resource('tags','TagController');
    Route::resource('posts','PostController');
    Route::get('/trashed','PostController@trash')->name('trash.index');
    Route::get('/restore/{id}','PostController@restore')->name('restore');
});

Route::middleware(['auth','admin'])->group(function(){
    Route::get('users','UsersController@index')->name('users.index');
    // if i change the user with any world it's error!! why? 
    Route::post('users/{user}/toAdmin','UsersController@makeAdmin')->name('users.makeAdmin');
    Route::post('users/{user}/toWriter','UsersController@makeWriter')->name('users.makeWriter');
    Route::post('users/{user}/delete','UsersController@destroy')->name('users.destroy');
    
    // Route::get('users/create','UsersController@create')->name('users.create');
    // Route::get('users/store','UsersController@store')->name('users.store');
    // Route::get('users/{id}/edit','UsersController@edit')->name('users.edit');
    // Route::get('users/{id}/update','UsersController@update')->name('users.update');
});
Route::middleware(['auth'])->group(function(){
    Route::get('users/{user}/profile','UsersController@profile')->name('users.profile');
    Route::get('users/{user}/edit','UsersController@edit')->name('users.edit');
    Route::post('users/{user}/update','UsersController@update')->name('users.update');
});

