@extends('adminlte::page') 

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
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
				<th>#order</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Address</th>
				<th>Status</th>
				<th>Total sum</th>
				<th>Created at</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($orders as $order)
				<tr style="height:100px;" data-id="{{$order->id}}">
					<td><a href="/admin/order/{{$order->id}}">{{$order->id}}</a></td>
					<td>
						@if($order->user_id) 
						<!-- если залогиненный пользователь -->
							<a href="/admin/order/user/{{$order->user_id}}">{{$order->name}}</a>
						@else 
							{{$order->name}}
  						@endif
					</td>
					<td>{{$order->email}}</td>
					<td>{{$order->phone}}</td>
					<td>{{$order->address}}</td>
					<td>{{$order->status->name}}</td>
					<td>{{$order->total_sum}}</td>
					<td>{{$order->created_at}}</td>
			@endforeach		
		</tbody>
	</table>   
@stop

@section('js')

<script>
	$(document).ready( function () {
    	$('#table').DataTable();
	} );

</script>>

@endsection

