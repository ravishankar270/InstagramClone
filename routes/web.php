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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::post('/follow/{user}','FollowsController@store');
Route::get('/p/create','PostsController@create');
Route::get('/','PostsController@index');
Route::post('/p','PostsController@store');
Route::get('/p/{post}','PostsController@show');
Route::get('/p/{user}/edit','ProfilesController@edit')->name('profile.edit');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');
