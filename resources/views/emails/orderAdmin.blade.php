<h1>{{$order->id}}</h1>

@foreach(session('cart') as $product)
{{--т.к. массив обращаемся через[]--}}
<div class="row product">
	<div class="col-3">
		<img src="{{$product['img']}}" alt="" class="img-fluid">
	</div>
	<div class="col-8">
		<h4>{{$product['name']}}</h4>
		{{$product['qty']}} * {{$product['price']}} = {{$product['qty'] * $product['price']}}
	</div>
</div>
@endforeach