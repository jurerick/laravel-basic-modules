@extends('admin.layouts.' . $settings->adminLayout)

@section('title')
	Dashboard
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

	<h1>@yield('title')</h1>
	
	
@stop