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
        //make sure that we never get the superadmin in admin view
        $userRoleIds = array();

        $userRole = DB::table('roles')->where('name', 'user');

        if($this->getRole()->isSuperAdmin){
            $userRole->orwhere('name', 'admin');
        }

        $userRole = $userRole->get();

        foreach ($userRole as $value) {
            $userRoleIds[] = $value->id;
        }

        $users = User::wherein('role_id', $userRoleIds)->get();

        return View::make('modules::admin.user.index', array('users' => $users));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {   
        $roleSelect = array();

        $roles = DB::table('roles')->orderBy('id', 'desc')->get();

        foreach($roles as $_role){
            $roleSelect[$_role->id] = ucwords(str_replace('_', ' ', $_role->name));
        }

        return View::make('modules::admin.user.create', array('roles' => $roleSelect));
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
            
            $roleId = (Input::has('role_id')) ?  Input::get('role_id') : Role::where('name', '=', 'user')->first()->id;

            $data = array(
                'fname' => Input::get('fname'),
                'lname' => Input::get('lname'),
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password')),
                'email' => Input::get('email'),
                'role_id' => $roleId, 
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

        $roleSelect = array();

        $roles = DB::table('roles')->orderBy('id', 'desc')->get();

        foreach($roles as $_role){
            $roleSelect[$_role->id] = ucwords(str_replace('_', ' ', $_role->name));
        }

        $user = User::find($id);

        return View::make('modules::admin.user.edit', array('user' => $user, 'roles' => $roleSelect));
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
            $user->active = Input::get('active');
            
            if(Input::has('role_id')){
                $user->role_id = Input::get('role_id');
            }
            
            $user->username = Input::get('username');
            
            if(Input::has('password')){
                $user->password = Hash::make(Input::get('password'));  
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