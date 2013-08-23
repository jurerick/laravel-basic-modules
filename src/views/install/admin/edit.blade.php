@extends('modules::install.layout')

@section('title')
	Admin Settings
@stop

@section('content')
	
	<h1>@yield('title')</h1>

	@if($successMsg) <p class='success'>{{ $successMsg }}</p> @endif

	{{ Form::open(array('action' => array('Install_AdminController@update', $admin->id), 'method' => 'put')) }}

		<div>
			{{ Form::label('fname', 'First Name') }}
			{{ Form::text('fname', $admin->fname) }}
			{{ $errors->first('fname', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::label('lname', 'Last Name') }}
			{{ Form::text('lname', $admin->lname) }}
			{{ $errors->first('lname', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::label('email', 'Email') }}
			{{ Form::text('email', $admin->email) }}
			{{ $errors->first('email', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::label('username', 'Username') }}
			{{ Form::text('username', $admin->username) }}
			{{ $errors->first('username', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password') }}
			{{ $errors->first('password', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::submit('Save') }}
			{{ HTML::linkAction('Install_DbController@migrateSuccess', 'Cancel') }}
		</div>

	{{ Form::close() }}

@stop