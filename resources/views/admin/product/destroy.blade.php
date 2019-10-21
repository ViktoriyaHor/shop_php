@extends('adminlte::page') 

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
@stop

@section('content')
<div>
	
	{{$product->name}}
						
		<form action="/admin/product/{{$product->id}}" method="POST">
         <input type="hidden" name="_method" value="DELETE">
         @csrf
		{{--<a href="users/{{$product->id}}">Удалить</a>--}}
		<button class="btn btn-danger">Подтвердить удаление</button>
	</form>  
					
</div>

@stop

@section('js')
<script>
	
</script>>

@endsection