@extends('layouts.app')

@section('content')
<div class="container">
   <h1>{{$product->name}}</h1>
   <div class="row">
     <div class="col-4">
       <img src="{{$product->img}}" alt="" class="img-fluid">
     </div>
     <div class="col-8">
       <div class="price">Price: {{$product->price}}</div>
       <div class="quantity">
         @if($product->quantity)
            In stock: {{$product->quantity}}
            <form action="" class="add-to-card">
              <div class="form-group">
                <label for="qty">Quantity:</label>
                <input type="number" name="qty" id="qty" value="1" class="form-control" min="1" max="{{$product->quantity}}">{{--min="1" max="{{$product->quantity}} для ограничение количества покупаемого товара, чтобы оно не превышало кол-во товаров на складе--}}
              </div>

              <input type="hidden" name="id" value="{{$product->id}}">
              <button class="btn btn-primary btn-block">Add to cart</button>
            </form>
         @else
            <p>Товар отсутствует на складе!</p>
         @endif
      </div>

     </div>
   </div>
   <div class="row">
      <div class="col">
      <h2>Description</h2>
      {!! $product->description !!}
    </div>
   </div>

</div>
@endsection

