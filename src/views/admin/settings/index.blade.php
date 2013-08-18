@extends('modules::admin.layouts.settings')

@section('title')
	Edit Application Settings
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

@section('content')
	
	@if($successMsg) <p class='success'>{{$successMsg}}</p> @endif

	<h1>@yield('title')</h1>

	{{ Form::open(array('action' => 'Admin_SettingsController@postEdit')) }}
		
		<div>
			{{ Form::label('app_name', 'Application Name') }}
			{{ Form::text('app_name', $settings->appName) }}
			{{ $errors->first('app_name', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::label('admin_layout', 'Admin Layout') }}
			{{ Form::text('admin_layout', $settings->adminLayout) }}
			{{ $errors->first('admin_layout', '<span class="error">:message</span>') }}
		</div>
		<div>
			{{ Form::label('default_layout', 'Default Layout') }}
			{{ Form::text('default_layout', $settings->defaultLayout) }}
			{{ $errors->first('default_layout', '<span class="error">:message</span>') }}
		</div>
		
		<div>
			{{ Form::submit('Save') }} {{ HTML::linkAction('Admin_DashboardController@index', 'Cancel') }}
		</div>
		
	{{ Form::close() }}
@stop


