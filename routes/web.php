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
Auth::routes();

Route::get('/', 'PostController@index')->name('index');
Route::get('/post/create', 'PostController@create')->name('post.create')->middleware('auth');
Route::get('/post/detail/{id}', 'PostController@show')->name('post.show');
Route::get('/post/edit', 'PostController@edit')->name('post.edit');
Route::post('/user/store', 'PostController@store')->name('post.store');
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');


