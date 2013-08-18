<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('page-not-found', 'JepController@pageNotFound');
Route::get('admin/page-not-found', 'JepController@pageNotFound');
Route::get('/', array('before' => 'auth', 'uses' => 'Default_DashboardController@index'));
Route::get('logout', array('as' => 'logout', 'uses' => 'JepController@logout'));

/*Login*/
Route::controller('login', 'Default_LoginController');
Route::get('login', array('before' => 'guest', 'uses' => 'Default_LoginController@getIndex'));


/*Dashboard*/
Route::group(array('before' => 'auth'), function(){
	Route::get('dashboard', 'Default_DashboardController@index');
});
Route::group(array('before' => 'admin-auth', 'prefix' => 'admin'), function(){
	Route::get('/', 'Admin_DashboardController@index');
	Route::get('dashboard', 'Admin_DashboardController@index');
});


/*Account*/
Route::group(array('before' => 'auth'), function(){
	Route::controller('account', 'Default_AccountController');
});
Route::group(array('before' => 'admin-auth', 'prefix' => 'admin'), function(){
	Route::controller('account', 'Admin_AccountController');
});


/*Users*/
Route::group(array('before' => 'admin-auth', 'prefix' => 'admin'), function(){
	Route::resource('user', 'Admin_UserController');
});

/*Settings*/
Route::group(array('before' => 'superadmin-auth', 'prefix' => 'admin'), function(){
	Route::controller('settings', 'Admin_SettingsController');
});

