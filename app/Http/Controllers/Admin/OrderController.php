<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItems;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        $title = 'Orders';
        return view('admin.order.index', compact('orders', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $orders = Order::all();
        $statuses = \App\Status::all();
        $title = 'Detail order #'.$id;
        $items = $order->items; //все данные доступны
        return view('admin.order.show', compact('orders', 'order', 'statuses', 'items', 'title'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function userHistory($id)
    {
        $user = \App\User::find($id);
        $orders = $user->orders;
        $title = 'User history';
        return view('admin.order.history', compact('user', 'orders', 'title'));

        // dd($user->orders);
    }

    public function selectStatus(Request $request)
    {
        $id = $request->orderId;
        $order = Order::find($id);
        $order->status_id = $request->statusId;
        $order->save();
        return redirect('/admin/order/'. $id)->with('message', 'Order '. $order->id . ' change status!');
    }
    public function showProducts(Request $request)
    {
        $id = $request->id;
        $order = Order::find($id);
        $items = $order->items; //все данные доступны
        echo $items;
    }
}
