@extends('modules::install.layout')

@section('title')
	Application Settings
@stop

@section('content')
	
	<h1>@yield('title')</h1>

	@if($successMsg) <p class='success'>{{ $successMsg }}</p> @endif

	{{ Form::open(array('action' => 'Install_ConfigController@store')) }}

		<div>
			<?php $appName = ($settings) ? $settings->appName : '' ?>
			{{ Form::label('app_name', 'Application Name') }}
			{{ Form::text('app_name', $appName) }}
			{{ $errors->first('app_name', '<span class="error">:message</span>') }}
		</div>
		<div>
			<?php $adminLayout = ($settings) ? $settings->adminLayout : '' ?>
			{{ Form::label('admin_layout', 'Admin Layout') }}
			{{ Form::text('admin_layout', $adminLayout) }}
			{{ $errors->first('admin_layout', '<span class="error">:message</span>') }}
		</div>
		<div>
			<?php $defaultLayout = ($settings) ? $settings->defaultLayout : '' ?>
			{{ Form::label('default_layout', 'Default Layout') }}
			{{ Form::text('default_layout', $defaultLayout) }}
			{{ $errors->first('default_layout', '<span class="error">:message</span>') }}
		</div>

		<div>
			{{ Form::submit('Save') }}
			{{ HTML::linkRoute('admin-edit', 'Back', array('id' => $adminId)) }}
		</div>

	{{ Form::close() }}

@stop