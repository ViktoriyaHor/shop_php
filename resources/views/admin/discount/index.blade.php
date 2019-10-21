@extends('adminlte::page') 

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
@stop

@section('content')

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
				<th>Value</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($discounts as $discount)
				<tr style="height:100px;">
					<td>{{$loop->iteration}}</td>
					<td class="editing">{{$discount->name}}
                        <div class="actions hidden">
							<div class="block edit">
								<a href="discount/{{$discount->id}}/edit">Изменить</a>  
								<form action="discount/{{$discount->id}}" method="POST">
									@csrf
    	                         	<input type="hidden" name="_method" value="DELETE">
									<button style="background: none; border: none; cursor: pointer; margin: 0; padding: 0; color: #3c8dbc;">Удалить</button>
								</form>  
							</div>
						</div>
					</td>
					<td>{{$discount->value}}</td> 
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