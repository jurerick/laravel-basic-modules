<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Jep modules used tables
	|--------------------------------------------------------------------------
	|
	| This will return the database tables of jep modules package.
	| Return an array with table name as its index and boolean as its value telling where table exists or not
	|
	*/

	'tables' => array(
			DB::getTablePrefix() . 'config' => Schema::hasTable(DB::getTablePrefix() . 'config'),
			DB::getTablePrefix() . 'roles' => Schema::hasTable(DB::getTablePrefix() . 'roles'),
			DB::getTablePrefix() . 'users' => Schema::hasTable(DB::getTablePrefix() . 'users'),
		)

);