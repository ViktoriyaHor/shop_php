<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;

class CartController extends Controller
{
    //контроллер для работы с корзиной
    public function addProduct(Request $request)
    {
    	$product = Product::find($request->id);
    	Cart::add($product,$request->qty);
        return view('product.minicart');

    }
    public function removeAll()
    {
    	
    	Cart::clear();
        return view('product.minicart');

    }
    public function removeProduct(Request $request)
    {
        $product = Product::find($request->id);
        Cart::remove($product);
        return view('product.minicart');

    }
    public function checkout()
    {
        return view('product.checkout');
    }

    public function buy(Request $request)
    {
        // запись в бд
        // отправка email
        // очистка корзины
        // редирект с сообщением

        $order = new \App\Order(); // обязательно \
        $order->user_id = $request->user_id ? $request->user_id : null;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->total_sum = session('totalSum');
        if(session('sumToPay')){$order->sum_to_pay = session('sumToPay');}
         
        $order->status_id = 1;         
        $order->save(); // теперь доступно id order

        foreach(session('cart') as $product){
            $item = new \App\OrderItems; //на каждый товар новая запись в бд
            $item->order_id = $order->id;
            $item->product_id =$product['id'];
            $item->product_name =$product['name'];
            $item->product_price =$product['price'];
            $item->product_qty =$product['qty'];
            $item->save();
            }

        // \Mail::send('emails.orderAdmin', compact('order'), function($message) use ($order){
        //         $message->to('vhorshag@gmail.com')->subject('New order #'.$order->id);
        // });  // отправим представление

        // Cart::clear(); 

        event(new \App\Events\ChangeOrderEvent($order));  

        return redirect('/')->with('message', 'Thank! Your order #'.$order->id);   // одноразовое сообщение из сессии
    }
}
