@extends('adminlte::page') 

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
@stop

@section('content')

@include('layouts.errors')

	<form action="/admin/category" method="POST">
		@csrf
		<div class="form-group">
			<label for="name">Name:</label>
			<input type="text" class="form-control" id="name" name="name">
		</div>
		<div class="form-group">
			<label for="slug">Slug:</label>
			<input type="text" class="form-control" id="slug" name="slug">
		</div>



		<div class="form-group">
			<label for="parentId">Parent Category:</label>
			<select class="form-control" id="parentId" name="parentId">
				<option value="0"></option> 
				@foreach($categories as $category)
				<option value="{{$category->id}}">{{$category->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="input-group">
		   <span class="input-group-btn">
		     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
		       <i class="fa fa-picture-o"></i> Choose
		     </a>
		   </span>
		   <input id="thumbnail" class="form-control" type="text" name="filepath">
		 </div>
 <img id="holder" style="margin-top:15px;max-height:100px;">
		<button class="btn btn-danger">Save</button>
	</form>
@stop

@section('js')
 <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script>
 $('#lfm').filemanager('image');
	// $(document).ready( function () {
 //    	$('#table').DataTable();
	// } );
</script>>

@endsection