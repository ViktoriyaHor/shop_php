@extends('adminlte::page') 

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
@stop

@section('content')

@include('layouts.errors')

	<form action="/admin/users/{{$user->id}}" method="POST">
    	<input type="hidden" name="_method" value="PUT">
		@csrf
		<div class="form-group">
			<label for="name">Name:</label>
			<input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" class="form-control" id="password" name="password" value="">
		</div>
		<div class="form-group">
			<label for="roles">Roles:</label>
			<select class="form-control" id="roles" name="roles[]" multiple>
				@foreach($roles as $role)
				<option value="{{$role->id}}" {{$user->roles->contains('id', $role->id)?'selected':''}}>{{$role->name}}</option>
				@endforeach
			</select>
		</div>
		{{-- button.btn.btn-primary>{Save} --}}
		<button class="btn btn-danger">Save</button>
	</form>
@stop

@section('js')
<script>
	$(document).ready( function () {
    	$('#roles').select2();
	} );
	// $(document).ready( function () {
 //    	$('#table').DataTable();
	// } );
</script>>

@endsection