@extends('adminlte::page') 

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
@stop

@section('content')

@include('layouts.errors')

	<form action="/admin/discount" method="POST">
		@csrf
		<div class="form-group">
			<label for="name">Name:</label>
			<input type="text" class="form-control" id="name" name="name">
		</div>
		<div class="form-group">
			<label for="value">Value:</label>
			<input type="text" class="form-control" id="value" name="value">
		</div>
		<button class="btn btn-danger">Save</button>
	</form>
@stop

@section('js')
@endsection