@extends('default.layouts.main')

@section('title')
	Login
@stop

@section('header')
@stop

@section('content')
	<h1>Login</h1>
	
	{{ $errors->first('auth', '<p class="error">:message</p>') }}
	
	{{ Form::open(array('action' => 'Default_LoginController@postIndex')) }}
		
		<div>
			{{ Form::label('username', 'Username') }}
			{{ Form::text('username') }}
			{{ $errors->first('username', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password') }}
			{{ $errors->first('password', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::submit('Login') }}
		</div>
	
	{{ Form::close() }}
@stop