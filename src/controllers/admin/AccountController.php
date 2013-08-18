<?php

class Admin_AccountController extends JepController {

  public function __construct(){

    $this->beforeFilter('csrf', array('on' => 'post'));

  }

  public function getEdit()
    {   
        $user = User::find(Auth::user()->id);
        
        return View::make('modules::admin.account.index', array('account' => $user));
        
    }
    
    public function postEdit(){
        
        $rules = array(
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'username' => 'required',
        );
        
        $valid = $this->validate(Input::all(), $rules);
        
        if($valid !== true){
        
            $errors = $valid->messages();
            
        }else{
        
            $user = User::find(Auth::user()->id);
            
            $user->fname = Input::get('fname');
            
            $user->lname = Input::get('lname');
            
            $user->email = Input::get('email');

            $user->username = Input::get('username');

            $password = Input::get('password');
            if(!empty($password)){
                $user->password = Hash::make($password);
            }
            
            $user->save();
            
            $errors = null;

            Session::flash('successMsg', 'Account successfully saved.');
        }
        
        return Redirect::to('admin/account/edit')->withErrors($errors)->withInput();
        
    }

}