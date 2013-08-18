<?php

/**
* Admin role filter
*/
Route::filter('admin-auth', function()
{	
	if(Auth::check()){
		
		$allowed_roles = array('super_admin', 'admin');

		$role = User::find(Auth::user()->id)->role->name;

		if(!in_array($role, $allowed_roles)){
			return Redirect::guest('login');
		}
		
	}elseif(Auth::guest()){
		return Redirect::guest('login');
	}
});

/**
* Super Admin role filter
*/
Route::filter('superadmin-auth', function()
{	
	if(Auth::check()){

		$role = User::find(Auth::user()->id)->role->name;

		if($role != 'super_admin'){
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
		$allowed_roles = array('super_admin', 'admin');
			
		$role = User::find(Auth::user()->id)->role->name;

		if(in_array($role, $allowed_roles)) return Redirect::to('admin/page-not-found');
		
	}

    return Redirect::to('page-not-found');

});