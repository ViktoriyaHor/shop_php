<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $title = 'Categories';
        return view('admin.category.index', compact('categories', 'title'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $title = 'Add Category';
        return view('admin.category.create', compact('categories', 'title'));
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
            'name'=>'required|unique:categories,name|max:64'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_id = $request->parentId==0?null:$request->parentId;
        $category->img = $request->filepath;
        $category->save();
        return redirect('/admin/category')->with('message', 'Category '. $category->name . ' added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $category =Category::find($id);
        $title = 'Edit category';
        $categories = Category::all();
        return view('admin.category.edit', compact('category','title', 'categories'));
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
        $category =Category::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_id = $request->parentId==0?null:$request->parentId;
        $category->img = $request->filepath;

        $request->validate([
            'name'=>'required|unique:categories,name,'.$id.'|max:64'
        ]);  

        $category->save();
        return redirect('/admin/category')->with('message', 'Category '. $category->name . ' updated!');
       
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
        Category::find($id)->delete();
        return redirect('/admin/category');
    }
}
