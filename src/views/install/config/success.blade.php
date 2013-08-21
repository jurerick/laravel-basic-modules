@extends('modules::install.layout')

@section('title')
	Application Settings
@stop

@section('content')
	
	<h1>@yield('title')</h1>

	@if($successMsg) <p class='success'>{{ $successMsg }}</p> @endif

	{{ Form::open(array('action' => 'Install_BaseController@finish')) }}
	
		{{ Form::submit('Finish') }}
		{{ HTML::linkAction('Install_ConfigController@create', 'Back') }}

	{{ Form::close() }}
	
@stop