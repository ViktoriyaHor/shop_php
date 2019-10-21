@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Checkout</h1>
  <h2 class="mt-3">Your cart</h2>
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

    <h2 class="mt-3">Information</h2>
    <form action="/buy" method="POST">
      @csrf
      <input type="hidden" name="user_id" class="form-control" @auth value="{{Auth::user()->id}}" @endauth> 
      <!-- если пользователь залогинен отправляется его id, если нет отпр пустая строка -->
      <div class="form-group">
        <label for="name">Name: </label>
        <input type="text" id="name" name="name" class="form-control" @auth value="{{Auth::user()->name}}" @endauth>
      </div>
      <div class="form-group">
        <label for="email">Email: </label>
        <input type="text" id="email" name="email" class="form-control" @auth value="{{Auth::user()->email}}" @endauth>
      </div>
      <div class="form-group">
        <label for="phone">Phone: </label>
        <input type="text" id="phone" name="phone" class="form-control">
      </div>
      <div class="form-group">
        <label for="address">Address: </label>
        <input type="text" id="address" name="address" class="form-control">
      </div>
      <button class="btn btn-primary">Buy</button>
    </form>
 
</div>
@endsection