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
				<th>#Product</th>
				<th>Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			@php($sum = 0)
			@foreach ($items as $item)
				<tr style="height:100px;" data-id="{{$item->product_id}}">
					<td>{{$loop->iteration}}</td>
					<td>{{$item->product_name}}</td>
					<td>{{$item->product_price}}</td>
					<td>{{$item->product_qty}}</td>
					<td>{{$sum_product = $item->product_price * $item->product_qty}}</td>
					@php($sum += $sum_product)
				</tr>	
			@endforeach		
				
		</tbody>
	</table>  
	<h5>Total sum {{$sum}}</h5>
	<!-- <h5>Total sum {{$order->total_sum}}</h5> -->
	<form action="/admin/select-status" method="POST">
		@csrf
		<div class="form-group">
			<input type="hidden" name="orderId" value="{{$order->id}}">
			<label for="statusId">Status:</label>
			<select class="form-control" id="statusId" name="statusId">
				@foreach($statuses as $status)
				<option value="{{$status->id}}" {{$order->status_id == $status->id ? 'selected' : ''}}>{{$status->name}}</option>
				@endforeach
			</select>
		</div>
		<button class="btn btn-primary" style="margin-bottom: 10px;">Select status</button>
	</form> 
@stop

@section('js')

<script>
	$(document).ready( function () {
    	$('#table').DataTable();
	} );



</script>>

@endsection

