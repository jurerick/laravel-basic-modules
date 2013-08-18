<?php

class Admin_SettingsController extends JepController {

    public function __construct(){

        $this->beforeFilter('csrf', array('on' => 'post'));

    }

    public function getEdit()
    {   
        
        return View::make('modules::admin.settings.index');
        
    }
    
    public function postEdit(){
        
        $errors = null;

        $rules = array(
            'app_name' => 'required',
            'admin_layout' => 'required',
            'default_layout' => 'required'
        );

        $valid = $this->validate(Input::all(), $rules);

        if($valid === true){

            $config = Input::all();
 
            foreach($config as $key => $val){

                AppConfig::where('key', '=', $key)->update(array('value' => $val));

                Session::flash('successMsg', 'Application settings successfully saved.');
            }

        }else{

            $errors = $valid->messages();
        }

        return Redirect::to('admin/settings/edit')->withErrors($errors)->withInput();
    }

}