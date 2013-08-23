<?php 

class Install_DbController extends Install_BaseController {
	
	public function index()
    {   
        return View::make('modules::install.index');
    }

	public function create()
    {   

        return View::make('modules::install.db.create');
    }

    public function check(){
    	
    	/*
    	*	laravel throws error if unknown database is set to its database config file,
    	*	that's why we assumed that the connection was configured correctly if database name was not empty.
    	*/
    	if(DB::getDatabaseName()){

    		 Session::flash('successMsg', 'Database configured correctly.');

    		 return Redirect::action('Install_DbController@migrate');

    	}else{
    		//pending lead to create database form
    	}

    	return Redirect::action('Install_DbController@index');
    }

    public function migrate(){

    	return View::make('modules::install.db.migrate', array(
    			'database' => DB::getDatabaseName(), 
    			'tables' => Config::get('modules::tables')
    		));

    }

    public function postMigrate(){

    	$migration_repo = Schema::hasTable('migrations');
    	
    	if(!$migration_repo){
    	
    		Artisan::call('migrate:install');
    	}

    	//note: temporary command call in workbench.
        Artisan::call('migrate:reset');

    	Artisan::call('migrate', array('--bench' => 'jep/modules'));

    	Session::flash('successMsg', 'Migration Successful.');

    	return Redirect::action('Install_DbController@migrateSuccess');

    }

    public function migrateSuccess(){

        $superAdminId = User::where('role_id', Role::where('name', 'super_admin')->first()->id)->first()->id;

    	return View::make('modules::install.db.success', array(
    			'tables' => Config::get('modules::tables'),
                'adminId' => $superAdminId,
    		));
    }


}