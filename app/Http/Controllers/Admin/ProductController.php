<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::latest()->get();это можно выводить только последние
        $products = Product::all();
        $title = 'Products';
        return view('admin.product.index', compact('products', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        
        $title = 'Add Product';
        return view('admin.product.create', compact('categories', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'name'=> 'required|max:64',

          'description'=> 'required',
          'price'=> 'required|regex:/[+-]?([0-9]*[.])?[0-9]+/',
          'quantity'=> 'required|regex:/[+-]?([0-9]*[.])?[0-9]+/',
          'categoryId'=> 'required',
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->price = $request->price;
        $product->img = $request->filepath;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->recommended = $request->recommended?0:1;
        $product->category_id = $request->categoryId==0?null:$request->categoryId;
        
        $product->save();
        return redirect('/admin/product')->with('message', 'Product '. $product->name . ' added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //переход в новое окно для удаления
        $product = Product::find($id);
        $title = 'Товары для удаления:';
        return view('admin.product.destroy', compact('product','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //отображает форму редактирования
        $product = Product::find($id);
        $categories = Category::all();
        $title = 'Edit product';
        return view('admin.product.edit', compact('product', 'title', 'categories'));
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
        //получ данные с формы редактирования категории и записывает их в БД, заканчивается редиректом
        $product = Product::find($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->price = $request->price;
        $product->img = $request->filepath;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->recommended = $request->recommended?0:1;
        $product->category_id = $request->categoryId==0?null:$request->categoryId;
        
        $request->validate([
          'name'=> 'required|max:64',
          'description'=> 'required',
          'price'=> 'required|regex:/[+-]?([0-9]*[.])?[0-9]+/',
          'quantity'=> 'required|regex:/[+-]?([0-9]*[.])?[0-9]+/',
          'categoryId'=> 'required',
        ]);

        $product->save();
        return redirect('/admin/product')->with('message', 'Product '. $product->name . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //удаление по id, заканчивается редиректом
        echo $product =Product::find($id)->delete();
        //return redirect('/admin/product')->with('message', 'Product deleted!');
    }


    public function editRecommended(Request $request)// в Request $request id редактируемого товара из скрипта ajax
    {
        //echo $request->id;//ajax
        $product = Product::find($request->id);
        $product->recommended = $product->recommended?0:1;
        //если 1? то 0 иначе 1
        echo $product->save();//если успех, то true и будет 1 иначе 0

    }
    public function editPrice(Request $request) // в request будет id, передаем через data
    {
        // echo $request->id; // либо return $request->id
        $product = Product::find($request->id);
        $product->price = $request->valNew;
        echo $product->save();
    }
}
