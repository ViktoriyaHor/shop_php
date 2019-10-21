@extends('adminlte::page') 

@section('title', $title)

@section('content_header')
    <h1 class="inline-block">{{$title}}</h1>
	<a href='products/create' class="btn btn-danger margin">Добавить</a>
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
				<th>IMG</th>
				<th>Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Recommended</th>
				<th>Category</th>
			</tr>
		</thead>
		<tbody>
			@foreach($products as $product)
    	 	<tr data-id="{{$product->id}}"> {{-- добавим для js чтоб получить id --}}
    	 		<td>{{$loop->iteration}}</td>
                <td><img src="{{$product->img}}" alt="" style="width: 200px; max-width: 100%"></td>
    	 		<td>
                    <div class="editing">
                        <div class="name">{{$product->name}}</div>
                        <div class="actions hidden">
                            <a href="/admin/product/{{$product->id}}/edit" class="edit">Edit </a>
                            |
                            <button class="destroy delete-product" value="Delete">Delete</button>
                            </form>
                        </div>
                    </div>
                </td>
    	 		<td class="price">{{$product->price}}</td>
                <td>{{$product->quantity}}</td>
                <td>
                    <i class="edit-recommended fa-lg fa fa-chevron-down {{$product->recommended ? 'text-danger' : 'text-muted'}}"></i>
                    
                </td>
                <td>{{($product->category)? $product->category->name : ''}}</td>
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

