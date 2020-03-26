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

Route::resource('/admin','Admin\LoginController');
Route::put('/dologin','Admin\LoginController@dologin');
Route::group(['middleware'=>'login'],function(){
	Route::resource('/adminusers','Admin\AdminUsersController');
	Route::get('/ajaxadminusers','Admin\AdminUsersController@ajax');
	Route::get('/del','Admin\AdminUsersController@del');
	Route::resource('/users','Admin\UsersController');
	Route::get('/ajaxusers','Admin\UsersController@ajax');
	Route::resource('/group','Admin\GroupController');
	Route::get('/groupdel','Admin\GroupController@del');
	Route::get('/shouquan/{id}','Admin\GroupController@shouquan');
	Route::PUT('/doshouquan/{id}','Admin\GroupController@doshouquan');
	Route::resource('/node','Admin\NodeController');
	Route::get('/nodedel','Admin\NodeController@del');
	Route::resource('/discuss','Admin\DiscussController');
	Route::get('/discussdel','Admin\DiscussController@del');
	Route::resource('/logout','Admin\LogoutController');
});
