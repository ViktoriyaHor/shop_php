<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Session;
use App\User;
use App\Discount;

class Cart //extends Model
{
   static public function add($product, $qty)
    {
    	if(Session::get("cart.product_{$product->id}") ){//если что-то есть, то добавит кол-во
            $oldQty = Session::get("cart.product_{$product->id}.qty");//получили старое значение
            Session::put("cart.product_{$product->id}.qty", $qty + $oldQty);//перезаписали кол-во
    	}
    		else{
    	Session::put("cart.product_{$product->id}.name", $product->name);//для записи в сессию в ларавел, вложенность указываем через точку, 1й параметр-куда записываем, 2й параметр-что записываем
    	Session::put("cart.product_{$product->id}.price", $product->price);
    	Session::put("cart.product_{$product->id}.img", $product->img);
    	Session::put("cart.product_{$product->id}.id", $product->id);
    	Session::put("cart.product_{$product->id}.qty", $qty);//кол-во, просто переменная, т.к. мы ее передали через контроллер
    }
        self::setTotalSum();//вызывается статический метод своего класса

    }

    static public function remove($product)
    {
    	Session::pull("cart.product_{$product->id}", 'default');
        self::setTotalSum();
    }

    static public function clear()
    {
    	Session::forget('cart');
    	Session::forget('totalSum');
    }
    static private function setTotalSum()//вызывается только внутри этого класса
    {
    	//Проходим по массиву и пересчитываем сумму
    	$sum = 0;
    	foreach(Session::get('cart') as $product){
    		$sum+= $product['qty'] * $product['price'];
    	}
        if (\Auth::user()) {
            $user = \Auth::user();
                //dd(Discount::find(1));

            // dd($user->pensioner);
            // dd($user);
            // dd(count($user->orders)==0);
            if(count($user->orders)==0){
                $dis = Discount::find(2);
                $sum_to_pay = $sum - $dis->value;
                // dd($dis);
                // $sum_to_pay = 0;
            }
            elseif ($sum > 1000) {
                $dis = Discount::find(4);
                $sum_to_pay = $sum-$dis->value;
                // dd($dis);
                // $sum_to_pay =1;
            }
            Session::put('sumToPay', $sum_to_pay);
            Session::put('discount', $dis->value);

        }
        
    	Session::put('totalSum', $sum);
    }
}
