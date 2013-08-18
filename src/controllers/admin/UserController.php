<?php

class Admin_UserController extends JepController {

    public function __construct(){

        //implement cross-site request forgery filter
        $this->beforeFilter('csrf', array('only' => array('store', 'update')));

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //make sure that we never get the admin user
        $adminRole = Role::where('name', '=', 'admin')->first();

        $users = User::where('role_id', '!=', $adminRole->id)->get();

        return View::make('modules::admin.user.index', array('users' => $users));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {   

        return View::make('modules::admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'fname' => 'required',
            'lname' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email',
        );

        $valid = $this->validate(Input::all(), $rules);

        if($valid === true){
            
            $data = array(
                'fname' => Input::get('fname'),
                'lname' => Input::get('lname'),
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password')),
                'email' => Input::get('email'),
                'role_id' => 2,
                'active' => Input::get('active')
            );

            $user = User::create($data);

            if($user){

                Session::flash('successMsg', 'User has been saved.');

                return Redirect::To('admin/user');

            }
        }else{

            $errors = $valid->messages();

        }

        return Redirect::To('admin/user/create')->withErrors($errors)->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        return "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    { 

        $user = User::find($id);

        return View::make('modules::admin.user.edit', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $rules = array(
            'fname' => 'required',
            'lname' => 'required',
            'username' => 'required',
            'email' => 'required|email',
        );

        $valid = $this->validate(Input::all(), $rules);

        if($valid ===  true){

            $user = User::find($id);

            $user->fname = Input::get('fname');
            $user->lname = Input::get('lname');
            $user->email = Input::get('email');
            $user->username = Input::get('username');
            
            $password = Input::get('password');
            if(!empty($password)){
                $user->password = Hash::make($password);  
            } 

            $user->active = Input::get('active');

            $user->save();

            Session::flash('successMsg', 'User has been saved.');

        }else{
            $errors = $valid->messages();

            return Redirect::action('Admin_UserController@edit', array($id))->withErrors($errors)->withInput();
        }

        return Redirect::to('admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return 'true';
    }

}