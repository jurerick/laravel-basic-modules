@extends('modules::install.layout')

@section('title')
	Check Database Connection
@stop

@section('content')
	<h1>@yield('title')</h1>
	
	<div>
		<p>Note: Make sure that your database is configured properly in <code>app/config/database.php</code></p>

		{{ Form::open(array('action' => 'Install_DbController@check')) }}
			{{ Form::submit('Check database') }}
		{{ Form::close() }}

	</div>
@stop