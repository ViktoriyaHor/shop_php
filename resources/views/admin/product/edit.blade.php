@extends('adminlte::page') 

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
@stop

@section('content')

{{--@include('layouts.errors')--}}

	<form action="/admin/product/{{$product->id}}" method="POST">
		<input type="hidden" name="_method" value="PUT">
		@csrf
		<div class="form-group @error('name') has-error @enderror">
			<label for="name">Name:</label>
			<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$product->name}}">
		</div>
@error('name')
    {{--<div class="alert alert-danger">{{ $message }}</div>--}}
    <span class="help-block">{{ $message }}</span>
@enderror
		<div class="form-group @error('slug') has-error @enderror">
			<label for="slug">Slug:</label>
			<input type="text" class="form-control" id="slug" name="slug" value="{{$product->slug}}}}">
		</div>
@error('slug')
    {{--<div class="alert alert-danger">{{ $message }}</div>--}}
    <span class="help-block">{{ $message }}</span>
@enderror

<div class="form-group @error('price') has-error @enderror">
			<label for="price">Price:</label>
			<input type="text" class="form-control" id="price" name="price" value="{{$product->price}}">
		</div>
@error('price')
    {{--<div class="alert alert-danger">{{ $message }}</div>--}}
    <span class="help-block">{{ $message }}</span>
@enderror

<div class="form-group @error('quantity') has-error @enderror">
			<label for="quantity">Quantity:</label>
			<input type="text" class="form-control" id="quantity" name="quantity" value="{{$product->quantity}}">
		</div>
@error('quantity')
    {{--<div class="alert alert-danger">{{ $message }}</div>--}}
    <span class="help-block">{{ $message }}</span>
@enderror

<div class="checkbox">
    <label for="recommended"><input type="checkbox" id="recommended" name="recommended" value="{{$product->recommended}} "{{$product->recommended==1?'checked':''}}><p style="font-weight: bold; font-size: 15px;">Recommended</p></label>
</div>


{{--https://unisharp.github.io/laravel-filemanager/integration--}}
        <div class="form-group @error('description') has-error @enderror">
			<label for="description">Description:</label>
			<textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
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
				<option value="{{$category->id}}" {{$category->id==$product->category_id?'selected':''}}>{{$category->name}}</option>
				@endforeach
			</select>
		</div>

        @if ($product->img)
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
		   <input id="thumbnail" class="form-control" type="text" name="filepath" value="{{$product->img}}">
		 </div>

       <img id="holder" style="margin-top:15px;max-height:100px;" src="{{$product->img}}">
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
</script>>

@endsection