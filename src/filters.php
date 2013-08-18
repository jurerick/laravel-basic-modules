<?php

Route::filter('admin-auth', function()
{
	if(Auth::check()){

		$role = User::find(Auth::user()->id)->role->name;

		if($role != 'admin'){
			return Redirect::guest('login');
		}
		
	}elseif(Auth::guest()){
		return Redirect::guest('login');
	}
});


/**
* Display the 404 not found page.
*/
App::missing(function($exception)
{	
	if(Auth::check()){
			
		$role = User::find(Auth::user()->id)->role->name;

		if($role == 'admin') return Redirect::to('admin/page-not-found');
		
	}

    return Redirect::to('page-not-found');

});