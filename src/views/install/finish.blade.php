@extends('modules::install.layout')

@section('title')
	Installation done!
@stop

@section('content')
	<h1>@yield('title')</h1>
	
	<div>
		{{ HTML::linkRoute('homepage', 'Go To Frontpage', array(), array('target' => '_blank')) }} &nbsp;
		{{ HTML::linkRoute('adminpage', 'Go To Admin page', array(), array('target' => '_blank')) }}
	</div>
@stop