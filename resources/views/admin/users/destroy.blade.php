@extends('adminlte::page') 

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
@stop

@section('content')
<div>
	
	{{$user->name}}
						
		<form action="/admin/users/{{$user->id}}" method="POST">
         <input type="hidden" name="_method" value="DELETE">
         @csrf
		{{--<a href="users/{{$user->id}}">Удалить</a>--}}
		<button class="btn btn-danger">Подтвердить удаление</button>
	</form>  
					
</div>

@stop

@section('js')
<script>
	function deleteUser() {
        
    }
</script>>

@endsection