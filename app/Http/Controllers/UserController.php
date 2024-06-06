<?php

namespace App\Http\Controllers;


use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\PasswordRequest;
use App\Http\Requests\User\PhotoRequest;
use App\Http\Requests\User\StoreRequest;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function home(){
        $data=[
            'footer'=>true,
            'naw'=>true,
        ];
        return view('home')->with('data',$data);
    }

    public function profile(){
        $data=[
            'footer'=>true,
            'naw'=>true,
        ];
        return view('user.profile')->with('data',$data);
    }

    public function passwordpatch(PasswordRequest $request){
        $user=Auth::user();
        if($user->update(['password'=>$request->password])){
            return redirect()->route('profile')->with('success','Пароль был успешно изменен!');
        }
        return redirect()->route('profile')->with('error','Не удалось измененить пароль!');
    }

    public function photopatch(PhotoRequest $request){
        if((isset(Auth::user()->photo))){
            $photo=Auth::user()->photo;
        }
        $user=Auth::user();
        $path=$request->file('photo')->store('/','public');
        if($user->update(['photo'=>$path])){
            if((isset($photo))){
                Storage::disk('public')->delete($photo);
            }
            return redirect()->route('profile')->with('success','Фотография была успешно изменена!');
        }
        return redirect()->route('profile')->with('error','Не удалось измененить фотографию!');
    }

    public function signin(Request $request){
        return view('user.signin');
    }

    public function login(LoginRequest $request){
        if(Auth::attempt($request->validated())){
            if (Auth::user()->role === 'admin') {
                return redirect()->route('index')->with('success','Вы успешно авторизовались!');
            }
            return redirect()->route('home')->with('success','Вы успешно авторизовались!');
        }
        else{
            return redirect()->route('signin')->with('error','Неверный логин или пароль');
        }
    }
    public function create()
    {
        return view('user.create');
    }

    public function store(StoreRequest $request)
    {
        if(User::create($request->validated())){
            return redirect()->route('signin')->with('success','Пользователь создан!');
        }
        return redirect()->route('signup')->with('error','Не удалось создать пользователя!');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('signin')->with('success','Вы успешно вышли из системы!');
    }
}
