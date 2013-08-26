<?php

class Install_BaseController extends Controller {
	
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{

		View::share(array(
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



	protected function finish(){

		//delete the install route.
		File::delete(base_path(). '/workbench/jep/modules/src/install.php');

		return View::make('modules::install.finish');
	}


	

}