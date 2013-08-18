@extends('admin.layouts.' . $settings->adminLayout)

@section('title')
	Edit User
@stop


@section('header_links')
	@if($role->isSuperAdmin)
		<li>{{ HTML::linkAction('Admin_SettingsController@getEdit', 'Settings')}}</li>
	@endif
	@parent
@stop

@section('header')
	@include('admin.sections.header')
@stop

@section('nav')
	@include('admin.sections.nav')
@stop

@section('subnav')
@stop

@section('content')
	
	<h1>Edit User</h1>

	{{ Form::open(array('action' => array('Admin_UserController@update', $id), 'method' => 'put')) }}
		<div>
			{{ Form::label('fname', 'First Name') }}
			{{ Form::text('fname', $fname) }}
			{{ $errors->first('fname', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::label('lname', 'Last Name') }}
			{{ Form::text('lname', $lname) }}
			{{ $errors->first('lname', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::label('email', 'Email') }}
			{{ Form::text('email', $email) }}
			{{ $errors->first('email', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::label('active', 'Active') }}
			{{ Form::select('active', array(0 => 'No', 1 => 'Yes'), $active) }}
		</div>
		<div>
			{{ Form::label('username', 'Username') }}
			{{ Form::text('username', $username) }}
			{{ $errors->first('username', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password') }}
			{{ $errors->first('password', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::submit('Save') }}
			{{ HTML::linkAction('Admin_UserController@index', 'Cancel') }}
		</div>

	{{ Form::close() }}
@stop