<?php

class Default_AccountController extends JepController {

    public function __construct(){

        $this->beforeFilter('csrf', array('on' => 'post'));

    }

    public function getEdit()
    {   
        $user = User::find(Auth::user()->id);

        return View::make('modules::default.account.index', array('account' => $user));
        
    }
    
    public function postEdit(){
        
        $rules = array(
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
        );
        
        $valid = $this->validate(Input::all(), $rules);
        
        if($valid !== true){
        
            $errors = $valid->messages();
            
        }else{
        
            $user = User::find(Auth::user()->id);
            
            $user->fname = Input::get('fname');
            
            $user->lname = Input::get('lname');
            
            $user->email = Input::get('email');
            
            $user->save();
            
            $errors = null;

            Session::flash('successMsg', 'Account successfully saved.');
        }
        
        return Redirect::to('account/edit')->withErrors($errors);
        
    }

}