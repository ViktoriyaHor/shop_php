@if( session('cart') ){{--для обращения в сессии исп. ф-я session()--}}

{{--{{ dump(session('cart')) }}если в корзине что-то есть , мы записываем сессию, иначе корзина пуста

читать https://bootstrap-4.ru/docs/4.3.1/components/modal/  Методы
--}}

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
       	<div class="col-1">
       		<i class="fa fa-trash fa-lg text-danger remove-product" data-id={{$product['id']}}></i>
       	</div>
       </div>
    @endforeach
		<hr>
		Total: {{session('totalSum')}}
    @if(\Auth::user())
    Discount: {{session('discount')}}
    Sum to pay: {{session('sumToPay')}}
    @endif

 @else
 <p>Корзина пуста</p>
 @endif