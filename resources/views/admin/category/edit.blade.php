@extends('adminlte::page') 

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
@stop

@section('content')

@include('layouts.errors')

	<form action="/admin/category/{{$category->id}}" method="POST">
		<input type="hidden" name="_method" value="PUT">
		@csrf
		<div class="form-group">
			<label for="name">Name:</label>
			<input type="text" class="form-control" id="name" name="name" value="{{$category->name}}">
		</div>
		<div class="form-group">
			<label for="slug">Slug:</label>
			<input type="text" class="form-control" id="slug" name="slug" value="{{$category->slug}}">
		</div>

		<div class="form-group">
			<label for="parentId">Parent Category:</label>
			<select class="form-control" id="parentId" name="parentId">
				<option value="0"></option> 
				@foreach($categories as $cat)
				<option value="{{$cat->id}}" {{$category->parent&&$category->parent->id==$cat->id?'selected':''}}>{{$cat->name}}</option>
				@endforeach
			</select>
		</div>

       @if ($category->img)
            <div class="checkbox">
                <label><input type="checkbox" name="remove" class="remove-img">Delete image</label>
            </div>
        @endif

		<div class="input-group">
		   <span class="input-group-btn">
		     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
		       <i class="fa fa-picture-o"></i> Choose
		     </a>
		   </span>
		   <input id="thumbnail" class="form-control" type="text" name="filepath" value="{{$category->img}}">
		 </div>

		 {{--<img src="{{$category->img}}" style="width: 200px">--}}
		 <img id="holder" style="margin-top:15px;max-height:100px;" src="{{$category->img}}">
		<button class="btn btn-danger">Save</button>
	</form>
@stop

@section('js')
 <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script>
  $('#lfm').filemanager('image');
    $('.remove-img').click(function(){
        if( $(this).prop('checked') ){
            $('#thumbnail').val('');
            $('#holder').removeAttr('src');
        }
    });

    $('#thumbnail').change(function(){
        if( $(this).val() ){
            $('.remove-img').prop('checked', false)
        }
    })
</script>

@endsection