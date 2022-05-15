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

//post
Route::get('/', 'PostController@index')->name('index');
Route::get('/post/create', 'PostController@create')->name('post.create')->middleware('auth');
Route::get('/post/detail/{id}', 'PostController@show')->name('post.show');
Route::get('/post/edit/{id}', 'PostController@edit')->name('post.edit');
Route::post('/post/store', 'PostController@store')->name('post.store');
Route::post('/post/update', 'PostController@update')->name('post.update');

//tag
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

//room
Route::post('/user/{partner_id}/room', 'RoomController@create')->name('create_room');
Route::get('/user/{user_id}/room_main', 'RoomController@index')->name('chat_room_list');
Route::get('/user/{user_id}/room_redirect/{another_user_id}', 'RoomController@redirectRoom')->name('chat_room_redirect');
Route::get('/user/{user_id}/room_get/{room_id}', 'RoomController@getChatRoom')->name('chat_room_get');
Route::get('/user/{user_id}/room_list_get', 'RoomController@getRoomList')->name('room_list_get');

//chat
Route::get('/chat', 'ChatController@index')->name('chat.index');
Route::get('/chat/{room_id}/room_chat', 'ChatController@getAllChat');
Route::get('/user/{room_id}/get_latest_chat', 'ChatController@getLatestChat')->name('get_latest_chat');
Route::put('/user/{room_id}/chat_update', 'ChatController@update')->name('chat_update');
Route::post('/user/{room_id}/chat_delete', 'ChatController@destroy')->name('chat_delete');
Route::get('ajax/chat', 'ChatController@getChat');
Route::post('ajax/chat', 'ChatController@createChat');
