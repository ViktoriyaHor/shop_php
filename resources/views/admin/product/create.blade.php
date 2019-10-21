@extends('adminlte::page') 

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
@stop

@section('content')

{{--@include('layouts.errors')  убираем и-а вывода ошибок прямо в формах--}}

	<form action="/admin/product" method="POST">
		@csrf
		<div class="form-group @error('name') has-error @enderror">
			<label for="name">Name:</label>
			<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
		</div>
@error('name')
    {{--<div class="alert alert-danger">{{ $message }}</div>--}}
    <span class="help-block">{{ $message }}</span>
@enderror
		<div class="form-group @error('slug') has-error @enderror">
			<label for="slug">Slug:</label>
			<input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
		</div>
@error('slug')
    {{--<div class="alert alert-danger">{{ $message }}</div>--}}
    <span class="help-block">{{ $message }}</span>
@enderror

<div class="form-group @error('price') has-error @enderror">
			<label for="price">Price:</label>
			<input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
		</div>
@error('price')
    {{--<div class="alert alert-danger">{{ $message }}</div>--}}
    <span class="help-block">{{ $message }}</span>
@enderror

<div class="form-group @error('quantity') has-error @enderror">
			<label for="quantity">Quantity:</label>
			<input type="text" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}">
		</div>
@error('quantity')
    {{--<div class="alert alert-danger">{{ $message }}</div>--}}
    <span class="help-block">{{ $message }}</span>
@enderror

<div class="checkbox">
    <label for="recommended"><input type="checkbox" id="recommended" name="recommended" value=""><p style="font-weight: bold; font-size: 15px;">Recommended</p></label>
</div>





{{--https://unisharp.github.io/laravel-filemanager/integration--}}
        <div class="form-group @error('description') has-error @enderror">
			<label for="description">Description:</label>
			<textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
		</div>

@error('description')
    {{--<div class="alert alert-danger">{{ $message }}</div>--}}
    <span class="help-block">{{ $message }}</span>
@enderror

		<div class="form-group">
			<label for="categoryId">Category:</label>
			<select class="form-control" id="categorytId" name="categoryId">
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
 <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    $('#lfm').filemanager('image');

    var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
	CKEDITOR.replace('description', options);
</script>

@endsection