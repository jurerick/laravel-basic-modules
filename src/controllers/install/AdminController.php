<?php 

class Install_AdminController extends Install_BaseController {
	
    public function __construct(){

        //implement cross-site request forgery filter
        $this->beforeFilter('csrf', array('only' => array('store', 'update')));

    }

	public function create()   
    {   

        return View::make('modules::install.admin.create');
    }

    public function store(){

    	$rules = array(
    		'fname' => 'required',
    		'lname' => 'required',
    		'email' => 'required|email',
    		'username' => 'required',
    		'password' => 'required',
    		);

    	$valid = $this->validate(Input::all(), $rules);

    	if($valid !== true){

    		return Redirect::action('Install_AdminController@create')->withErrors($valid->messages())
    			->withInput();

    	}else{

    		DB::table('users')->delete();
    		DB::table('roles')->delete();

    		//create user roles
    		$roleData = array(
    				array('name' => 'super_admin' ),//The Super Administrator key
    				array('name' => 'admin'),
    				array('name' => 'user')
    			);
    		DB::table('roles')->insert($roleData);

    		//create the super administrator
    		$userData = array(
    				'fname' => Input::get('fname'),
    				'lname' => Input::get('lname'),
    				'email' => Input::get('email'),
    				'username' => Input::get('username'),
    				'password' => Hash::make(Input::get('password')),
    				'role_id' => Role::where('name', '=', 'super_admin')->first()->id,
    				'active' => 1,
    			);
    		$user = User::create($userData);

    		if($user){
   				Session::flash('successMsg', 'Administrator has been saved.');
            }

    	}
        
		return Redirect::action('Install_ConfigController@create');    	
    }

    public function edit($id){

        return View::make('modules::install.admin.edit', array('admin' => User::find($id)));

    }

    public function update($id){

        $rules = array(
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|email',
                'username' => 'required',
            );
        
        $valid = $this->validate(Input::all(), $rules);

        if($valid !== true){

            return Redirect::action('Install_AdminController@edit', array($id))->withErrors($valid->messages())
                ->withInput(); 

        }else{
            
            $admin = User::find($id);

            $admin->fname = Input::get('fname');
            $admin->lname = Input::get('lname');
            $admin->email = Input::get('email');
            $admin->username = Input::get('username');

            if(Input::has('password')){
                $admin->password = Hash::make(Input::get('password'));
            }

            $admin->save();

            Session::flash('successMsg', 'Administrator has been saved.');

        }


        return Redirect::action('Install_ConfigController@create');

    }


}
