@extends('default.layouts.main')

@section('title')
	Page Not Found
@stop

@section('header')
	<h1>{{ HTML::linkAction( $baseRoute . 'DashboardController@index', $appData->appName) }}</h1>
@stop

@section('content')
	<h1>The page is not found.</h1>
@stop