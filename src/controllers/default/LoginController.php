<?php

class Default_LoginController extends JepController {

	public function getIndex()
	{
		return View::make('modules::default.login.index');
	}
	
	public function postIndex(){ 
		
		$errors = null;
		
		$credentials = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);
		
		$rules = array(
			'username' => 'required',
			'password' => 'required'
		);
		
		$valid = $this->validate($credentials, $rules);
		
		if($valid !== true){
		
			$errors = $valid->messages();
			
		}else{
			
			if( Auth::attempt($credentials) ){
			
				if( Auth::check() ){
					
					$userIsActive = Auth::user()->active;
					
					if($userIsActive){
						
						$role = User::find(Auth::user()->id)->role->name;

						switch($role){
							case 'super_admin':
							case 'admin':
								return Redirect::to('admin/dashboard');
								break;
							default:
								return Redirect::to('/');
						}
						
					}
					else{
							
						Auth::logout();
						
						$errors = array('auth' => 'User is not active.');
					}
				}			
			}else{
			
				$errors = array('auth' => 'Invalid username or password.');
			}
		}
		
		return Redirect::to('login')->withErrors($errors);
		
	}
	
	
}