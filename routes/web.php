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

Route::get('home', 'HomeController@index')->name('home');

Route::get('trip', 'PostController@index');

Route::get('post/create', 'PostController@create')->middleware('auth');

Route::post('posts', 'PostController@store')->middleware('auth');

Route::get('post/{post}/delete', 'PostController@delete_dialog')->middleware('auth');

Route::post('post/{post}/delete', 'PostController@destroy')->middleware('auth');

Route::get('post/{post}/edit', 'PostController@edit')->middleware('auth');

Route::post('post/{post}/update', 'PostController@update')->middleware('auth');

Route::get('post/{post}', 'PostController@show');



Route::get('location/create', 'LocationController@create')->middleware('auth');

Route::post('locations', 'LocationController@store')->middleware('auth');

Route::get('location/{location}/delete', 'LocationController@delete_dialog')->middleware('auth');

Route::post('location/{location}/delete', 'LocationController@destroy')->middleware('auth');

Route::get('location/{location}/edit', 'LocationController@edit')->middleware('auth');

Route::post('location/{location}/update', 'LocationController@update')->middleware('auth');
