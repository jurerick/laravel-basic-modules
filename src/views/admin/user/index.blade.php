@extends('default.layouts.main')

@section('scripts')
	@include('modules::admin.sections.scripts')
@stop

@section('title')
	Manage Users
@stop

@section('header')
	@include('admin.sections.header')
@stop

@section('nav')
	@include('admin.sections.nav')
@stop

@section('subnav')
	@include('modules::admin.sections.subnav')
@stop

@section('content')
	
	@if($successMsg) <p class='success'>{{$successMsg}}</p> @endif
	
	<h1>Manage User</h1>

	<nav>
		<ul>@yield('subnav')</ul>
	</nav>

	<table>
		<thead>
			<th>Username</th>
			<th>Name</th>
			<th>Email</th>
			<th>Role</th>
			<th>Status</th>
			<th></th>
		</thead>
		<tbody>
			@foreach ($users as $user)
			<tr>
				<td>{{ $user->username }}</td>
			    <td>{{ $user->fname . ' ' . $user->lname }}</td>
			    <td>{{ $user->email }}</td>
			    <td>{{ $user->role->name }}</td>
			    <td>@if ( $user->active ) active @else inactive @endif</td>
			    <td>
			    	{{ HTML::linkAction('Admin_UserController@edit', 'Edit',  $user->id) }}
			    	{{ HTML::linkAction('Admin_UserController@destroy', 'Delete', $user->id, array('class' => 'js-delete')) }}
			    </td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<script>
	$(document).ready(function(){

		$('a.js-delete').click(function(event){

			event.preventDefault();

			$(this).deleteModel('user');

		});
		
	});
	</script>
@stop