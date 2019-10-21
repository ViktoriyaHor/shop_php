<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $title = 'Users';
        return view('admin.users.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $title = 'Add users';
        return view('admin.users.create', compact('roles', 'title'));
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
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =\Hash::make($request->password);
        $user->pensioner = $request->pensioner?0:1;
        //Hash - зашифровывает пароль или можно подключить вверху use Hash
        $user->save();//чтобы у user появилось свойство id. нужно сохранить в БД
        $user->roles()->sync($request->roles);
        //Many To Many Relationships/Syncing Associations https://laravel.com/docs/5.8/eloquent-relationships#updating-many-to-many-relationships
        return redirect('/admin/users')->with('message', 'User ' . $user->name . ' added!');
        //with() функция - это однаразовая сессия

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $user =User::find($id);
        $title = 'Вы указали следующего пользователя для удаления:';
        return view('admin.users.destroy', compact('user','title'));
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
        $user =User::find($id);
        $title = 'Edit user';
        $role =Role::find($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('user','title', 'role', 'roles'));
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
         $request->validate([
            'name'=>'required',
            //'email'=>'required|email|unique:users,email',
            'email' => 'required|email|unique:users,email,'.$id.'|max:40',
            'password'=>'nullable|min:8'
        ]);  
        //получ данные с формы редактирования категории и записывает их в БД, заканчивается редиректом
        $user =User::find($id);
        $user->name = $request->name;
        $user->pensioner = $request->pensioner?0:1;
        $user->email = $request->email;
        //$user->password =\Hash::make($request->password)?($request->password):'';
        //if (Hash::check('plain-text', $hashedPassword)) {
            # code...
        //}
        if($request->password){
            $user->password =\Hash::make($request->password);
        }
        //Hash - зашифровывает пароль или можно подключить вверху use Hash
       
        $user->save();//чтобы у user появилось свойство id. нужно сохранить в БД
        $user->roles()->sync($request->roles);
        //Many To Many Relationships/Syncing Associations https://laravel.com/docs/5.8/eloquent-relationships#updating-many-to-many-relationships
        return redirect('/admin/users')->with('message', 'User ' . $user->name . ' updated');
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
        User::find($id)->delete();
         return redirect('/admin/users');
        // $user =User::find($id);
        // $title = 'Вы указали следующего пользователя для удаления:';
        // return view('admin.users.destroy', compact('user','title'));
        
    }

    public function pensioner(Request $request)// в Request $request id редактируемого товара из скрипта ajax
    {
        //echo $request->id;//ajax
        $user = User::find($request->id);
        $user->pensioner = $user->pensioner?0:1;
        //если 1? то 0 иначе 1
        echo $user->save();//если успех, то true и будет 1 иначе 0

    }
    
}
