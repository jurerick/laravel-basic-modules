@extends('modules::install.layout')

@section('title')
	Migrate Tables
@stop

@section('content')
	
	<h1>@yield('title')</h1>

	@if($successMsg) <p class='success'>{{ $successMsg }}</p> @endif


	<p>The following tables will be created into database <strong>{{ $database }}</strong></p>

	<p>Warning: table with <span>conflict</span> mark will be DELETED 
			and will replace by installation with its own table structure.</p>


	@if(count($tables))
	<ul>
		@foreach($tables as $tbl => $is_exists)
			<li>{{ ucwords($tbl) }} {{ ($is_exists) ? '<span>conflict</span>' : '' }}</li>
		@endforeach
	</ul>
	@endif

	{{ Form::open(array('action' => 'Install_DbController@postMigrate')) }}
		{{ Form::submit('Continue') }}
		{{ HTML::linkAction('Install_DbController@index', 'Back') }}
	{{ Form::close() }}

@stop