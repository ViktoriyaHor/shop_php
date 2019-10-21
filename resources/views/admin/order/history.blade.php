@extends('adminlte::page') 

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
@stop

@section('content')

{{--@include('layouts.errors')  убираем и-а вывода ошибок прямо в формах--}}

<!-- 	@if (session('message'))
	    <div class="alert alert-success">
	        {{ session('message') }}
	    </div>
	@endif -->
	<table id="table">
		<thead>
			<tr>
				<th></th>
				<th>#Order</th>
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
				<tr style="height:100px;" role="row" data-id="{{$order->id}}">
					<td class="details-control"></td>
					<td>{{$order->id}}</td>
					<td>{{$order->email}}</td>
					<td>{{$order->phone}}</td>
					<td>{{$order->address}}</td>
					<td>{{$order->status->name}}</td>
					<td>{{$order->total_sum}}</td>
					<td>{{$order->created_at}}</td>
				</tr>	
			@endforeach		
				
		</tbody>
	</table>  
@stop

@section('js')

<script>
/* Formatting function for row details - modify as you need */
// function format (idP) {
//     // `d` is the original data object for the row
//     $.ajax({
//     	type: 'POST',
//     	url: '/admin/show-products',
//     	data: {
//         	id: idP,
//     	},
//         success: function(result){// в result== $request->id из метода контроллера;
//           return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
// 		    '<tr>'+
// 		        '<td>Full name:</td>'+
// 		        '<td></td>'+
// 		    '</tr>'+
// 		    '<tr>'+
// 		        '<td>Extension number:</td>'+
// 		        '<td></td>'+
// 		    '</tr>'+
// 		    '<tr>'+
// 		        '<td>Extra info:</td>'+
// 		        '<td>And any further details here (images etc)...</td>'+
// 		    '</tr>'+
// 		'</table>';
//         }
//     });
// };
 
$(document).ready(function() {
    var table = $('#table').DataTable( {
        // "ajax": "../ajax/data/objects.txt",
        // "columns": [
        //     {
        //         "className":      'details-control',
        //         "orderable":      false,
        //         "data":           null,
        //         "defaultContent": ''
        //     },
        //     { "data": "name" },
        //     { "data": "position" },
        //     { "data": "office" },
        //     { "data": "salary" }
        // ],
        // "order": [[1, 'asc']]
    } );
     
    // Add event listener for opening and closing details
    $('#table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        var id = tr.data('id');
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {

    // `d` is the original data object for the row
    $.ajax({
    	type: 'POST',
    	url: '/admin/show-products',
        dataType: 'json',
    	data: {
        	id: id,
    	},
        success: function(products){// в result== $request->id из метода контроллера;
            let tb = `<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;"> `;
                //console.log(JSON.parse(products));

        	$.each(products, function (index,item){
                console.log(item);
                tb += 
            `<tr>
                <td>Product name:</td>
                <td>${item.product_name}</td>
            </tr>
            <tr>
                <td>Price:</td>
                <td>${item.product_price}</td>
            </tr>
            <tr>
                <td>Quality:</td>
                <td>${item.product_qty}</td>
            </tr>
            <tr>
                <td>Total price:</td>
                <td>${item.product_price*item.product_qty}</td>
            </tr>`
            
            });
        	tb += `</table>`;    
			row.child( tb ).show();
            tr.addClass('shown');
        }
    });

 
            // // Open this row
            // row.child( format(id) ).show();
            // tr.addClass('shown');
        }
    } );
} );
</script>

@endsection