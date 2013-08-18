@extends('default.layouts.main')

@section('title')
	Edit Account
@stop

@section('header')
	@include('admin.sections.header')
@stop

@section('nav')
	@include('admin.sections.nav')
@stop

@section('content')
	
	@if($successMsg) <p class='success'>{{$successMsg}}</p> @endif

	<h1>Edit My Account</h1>
	{{ Form::open(array('action' => 'Admin_AccountController@postEdit')) }}
		
		<div>
			{{ Form::label('fname', 'First Name') }}
			{{ Form::text('fname', $account->fname) }}
			{{ $errors->first('fname', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::label('lname', 'Last Name') }}
			{{ Form::text('lname', $account->lname) }}
			{{ $errors->first('lname', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::label('email', 'Email') }}
			{{ Form::text('email', $account->email) }}
			{{ $errors->first('email', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::label('username', 'Username') }}
			{{ Form::text('username' , $account->username) }}
			{{ $errors->first('username', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password') }}
			{{ $errors->first('password', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::submit('Save') }} {{ HTML::linkAction('Admin_DashboardController@index', 'Cancel') }}
		</div>
		
	{{ Form::close() }}
@stop


