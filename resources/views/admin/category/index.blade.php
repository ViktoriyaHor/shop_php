@extends('adminlte::page') 

@section('title', $title)

@section('content_header')
	<h1 class="inline-block">{{$title}}</h1>
	<a href='categories/create' class="btn btn-danger margin">Добавить</a>
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
				<th>IMG</th>
				<th>Parent Category</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($categories as $category)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td class="editing">{{$category->name}}
                        <div class="actions hidden">
							<span class="edit">
								<a href="categories/{{$category->id}}/edit">Изменить</a> | 
							</span>
							<a href="categories/{{$category->id}}" class="red">Удалить</a>
						</div>
					</td>
					<td><img src="{{$category->img}}" alt="" style="width: 100px"></td>
					<td>{{$category->parent?$category->parent->name:''}}</td> 
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