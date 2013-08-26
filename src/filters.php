<?php

/**
* Admin role filter
*/
Route::filter('admin-auth', function($route)
{	
	if(Auth::check()){
		
		$allowed_roles = array('super_admin', 'admin');

		$role = User::find(Auth::user()->id)->role->name;

		if(!in_array($role, $allowed_roles)){

			return Redirect::guest('login');
		}


		//restricted routes for super admin

		$routeName = Route::currentRouteName();

		if($routeName == 'admin.user.edit'){
			
			$userIdEdit = $route->getParameter('user');

			$userRoleEdit = User::find($userIdEdit)->role->name;

			//do not allow to edit the super admin
			
			if($userRoleEdit == 'super_admin'){

				return Redirect::guest('login'); 	
			}
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