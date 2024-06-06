@extends('wrap')
@section('title','Авторизация')
@section('content')
    <form action="{{route('login')}}" method="POST">
        @method('POST')
        @csrf
        <h1 class="center">Авторизация</h1>
        <p>
            <label for="login">Логин</label>
            <input id="login" name="login" type="text"  class="sign-input" placeholder="Введите логин">
        </p>
        @foreach ($errors->get('login') as $error)
            <p class="error">
                {{$error}}
            </p>
        @endforeach
        <p>
            <label for="password">Пароль</label>
            <input id="password" name="password" type="password"  class="sign-input"  placeholder="Введите пароль">
        </p>
        @foreach ($errors->get('password') as $error)
            <p class="error">
                {{$error}}
            </p>
        @endforeach
        <p>
            <input type="submit" value="Войти"  class="sign-input sign-button button-form">
        </p>
        <p>
            Новичок в Мой опрос? <a href="{{route('signup')}}" class="link-blue">Регистрация</a>
        </p>
    </form>
@endsection
