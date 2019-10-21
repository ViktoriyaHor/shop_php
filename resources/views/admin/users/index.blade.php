@extends('adminlte::page') 

@section('title', $title)

@section('content_header')
		<h1 class="inline-block">{{$title}}</h1>
		<a href='users/create' class="btn btn-danger margin">Добавить</a>
@stop

@section('content')

{{-- https://laravel.com/docs/5.8/redirects#redirecting-with-flashed-session-data --}}
	@if (session('message'))
	    <div class="alert alert-success">
	        {{ session('message') }}
	    </div>
	@endif
	<table id="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Email</th>
				<th>Role</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr data-id="{{$user->id}}">
					
					<td>{{$loop->iteration}}</td>
					<td class="editing">{{$user->name}}
						<div class="actions hidden">
							<span class="edit">
								<a href="users/{{$user->id}}/edit">Изменить</a> | 
							</span>
							<a href="users/{{$user->id}}" class="red">Удалить</a>
						</div>
					</td>
					<td>{{$user->email}}</td>
					<td>{{$user->roles->implode('name', ', ')}}</td> 
					{{-- roles - это коллекция из модели метод Модели стал свойством --}}
				</tr>
			@endforeach		
		</tbody>
	</table>   
@stop
@section('js')
<script> 
	$(document).ready( function () {
    	$('#table').DataTable();
	} );
	$('.editing').hover(function(){
        $(this).children('.actions').toggleClass('hidden');
    });
</script>

@endsection