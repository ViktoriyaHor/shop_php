<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Action;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*$recommendedProducts = Product::where('recommended', '=', 1)->whereNotNull('img')->orderBy('created_at', 'DESC')->paginate(12);//'DESC' изменяем порядок от нового к старому товару*/

        // Если нужно получить все последние товары Product::latest();
        //$recommendedProducts =Product::latest()->paginate(12);

        
        // \Log::info('test', ['text']);
        $actions = Action::all();
        $recommendedProducts = Product:: recommended()->withImg()->latest()->paginate(12);//эти методы прописаны в модели Product

        return view('home', compact('recommendedProducts', 'actions'));
    }
    public function showProduct($slug)
    {
        $product = Product::where('slug', '=', $slug)->first();//выберет первый объект класса product
        return view('product.show', compact('product'));
    }
    public function orders()
    {
        $user = \Auth::user(); // чтоб не писать use \
        // dd($user->orders);
        return view('orders', compact('user'));
    }
}
