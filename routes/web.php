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

Route::group(['middleware' => ['auth']], function () {
	Route::get('/chat',[
		'uses' =>'HomeController@getChat',
		'as' => 'chat'
	]);
	Route::get('getUserLogin',[
		'uses' => "UserController@getCurrentUser",
		'as' => 'getUserLogin'
	]);
	Route::get('/page',[
		'uses' => 'HomeController@getPage',
		'as' => 'page'
	]);
	Route::resource('messages','MesssageController');
	Route::resource('pages','PageController');
	Route::resource('comments','CommentController');
});
