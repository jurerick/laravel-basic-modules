@extends('default.layouts.' . $settings->defaultLayout)

@section('title')
	Page Not Found
@stop

@section('header')
	<h1>{{ HTML::linkAction( $baseRoute . 'DashboardController@index', $settings->appName) }}</h1>
@stop

@section('content')
	<h1>The page is not found.</h1>
@stop