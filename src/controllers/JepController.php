<?php

class JepController extends Controller {
	
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{

		View::share(array(
			'appData' => AppConfig::get(),
			'auth' => Auth::user(),
			'module' => $this->getCurrentModule(),
			'baseRoute' => $this->baseRoute(),
			'successMsg' =>  Session::get('successMsg'),
		));
		
	}
	
	/**
	*  Validate data
	*  @param array $input
	*  @param array $rules
	*  @return obj validator data | bool true
	*/
	protected function validate($input, $rules, $messages = array()){
		
		$validator = Validator::make($input, $rules, $messages);
		
		return ($validator->fails()) 
			? $validator 
			: true;
	
	}

	protected function logout(){
		
		Auth::logout();
		return Redirect::to('/');

	}

	protected function pageNotFound(){

		return View::make('modules::default.page.404');

	}

	protected function getCurrentModule(){

		$ctrl = explode('@', Route::currentRouteAction());

		return $ctrl[0];

	}

	protected function baseRoute(){

		if(preg_match('/admin/', Route::currentRouteName()))
			return 'Admin_';
		else
			return 'Default_';
	}



}