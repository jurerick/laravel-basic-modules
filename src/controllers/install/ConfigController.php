<?php 

class Install_ConfigController extends Install_BaseController {

	function create(){

		return View::make('modules::install.config.create', array('settings' => AppConfig::get()));
	}


	function store(){

		$rules = array(
            'app_name' => 'required',
            'admin_layout' => 'required',
            'default_layout' => 'required'
        );

        $valid = $this->validate(Input::all(), $rules);

        if($valid === true){
 			
 			$configTableData = AppConfig::all();

	 		if(count($configTableData)){

	 			$this->updateSettings();

	 		}else{

				$this->createSettings();	 			
	 		}

        	 Session::flash('successMsg', 'Application settings successfully saved.');

             return Redirect::Action('Install_ConfigController@success');

        }else{

        	$errors = $valid->messages();
        }

        return Redirect::Action('Install_ConfigController@create')->withErrors($errors)->withInput();

	}

	/**
	*	Create the config table
	* 	@return void
	*/
	private function createSettings(){

		$config = array(

			array(
		        'key' => 'app_name',
		      	'name' => 'Application Name',
		   	   	'value' => Input::get('app_name'),
	         ),
		     array(
		        'key' => 'admin_layout',
		        'name' => 'Admin Layout',
		        'value' => Input::get('admin_layout'),
		    ),
		    array(
		    	'key' => 'default_layout',
		        'name' => 'Default Layout',
		        'value' => Input::get('default_layout')
		    ),
		);

		DB::table('config')->insert($config);
	}

	/**
	*	Update the config table
	* 	@return void
	*/
	private function updateSettings(){
		$config = Input::all();
 
        foreach($config as $key => $val){

           AppConfig::where('key', '=', $key)->update(array('value' => $val));

        }
	}

	function success(){
		
		return View::make('modules::install.config.success');
	}

}