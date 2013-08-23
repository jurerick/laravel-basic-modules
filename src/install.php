<?php

/*
|--------------------------------------------------------------------------
| Install Route
|--------------------------------------------------------------------------
|	This Route handle all the pages of basic modules installation process.
|
*/

Route::group(array('prefix' => 'install-jep-modules'), function(){	
	Route::get('/', 'Install_DbController@index');

	Route::post('db/check', 'Install_DbController@check');
	Route::get('db/migrate', 'Install_DbController@migrate');
	Route::post('db/post-migrate', 'Install_DbController@postMigrate');
	Route::get('db/migrate-success', 'Install_DbController@migrateSuccess');
	
	Route::resource('admin', 'Install_AdminController');
	Route::get('admin/create', 'Install_AdminController@create');
	Route::post('admin/create', 'Install_AdminController@create');
	Route::post('admin/store', 'Install_AdminController@store');
	Route::get('admin/{id}/edit', array('as' => 'admin-edit', 'uses' => 'Install_AdminController@edit'));
	Route::post('admin/update', 'Install_AdminController@update');

	Route::get('config/create', 'Install_ConfigController@create');
	Route::post('config/create', 'Install_ConfigController@create');
	Route::post('config/store', 'Install_ConfigController@store');
	Route::get('config/success', 'Install_ConfigController@success');

	Route::post('finish', 'Install_BaseController@finish');
});
