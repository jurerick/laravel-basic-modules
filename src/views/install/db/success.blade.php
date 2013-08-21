@extends('modules::install.layout')

@section('title')
	Migrate Tables
@stop

@section('content')
	
	<h1>@yield('title')</h1>

	@if($successMsg) <p class='success'>{{ $successMsg }}</p> @endif

	@if(count($tables))
	<ul>
		@foreach($tables as $tbl => $is_exists)
			<li>{{ ucwords($tbl) }} {{ ($is_exists) ? '<span>migrated</span>' : '' }}</li>
		@endforeach
	</ul>
	@endif

	{{ Form::open(array('action' => 'Install_ConfigController@create')) }}
	
		{{ Form::submit('Continue') }}
		{{ HTML::linkAction('Install_DbController@migrate', 'Back') }}

	{{ Form::close() }}
	
@stop