@extends('adminlte::page') 

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
@stop

@section('content')

@include('layouts.errors')

	<form action="/admin/discount/{{$discount->id}}" method="POST">
		<input type="hidden" name="_method" value="PUT">
		@csrf
		<div class="form-group">
			<label for="name">Name:</label>
			<input type="text" class="form-control" id="name" name="name" value="{{$discount->name}}">
		</div>
		<div class="form-group">
			<label for="value">value:</label>
			<input type="text" class="form-control" id="value" name="value" value="{{$discount->value}}">
		</div>
		<button class="btn btn-danger">Save</button>
	</form>
@stop

@section('js')

@endsection