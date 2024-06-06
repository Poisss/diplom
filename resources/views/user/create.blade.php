@extends('wrap')
@section('title','Регистрация')
@section('content')
    <form action="{{route('logup')}}" method="POST">
        @method('POST')
        @csrf
        <h1 class="center">Регистрация</h1>
        <p>
            <label for="first_name">Имя</label>
            <input id="first_name" name="first_name" type="text" class="sign-input" placeholder="Введите имя">
        </p>
        @foreach ($errors->get('first_name') as $error)
            <p class="error">
                {{$error}}
            </p>
        @endforeach
        <p>
            <label for="last_name">Фамилия</label>
            <input id="last_name" name="last_name" type="text" class="sign-input" placeholder="Введите фамилию">
        </p>
        @foreach ($errors->get('last_name') as $error)
            <p class="error">
                {{$error}}
            </p>
        @endforeach
        <p>
            <label for="patronymic">Отчество</label>
            <input id="patronymic" name="patronymic" type="text" class="sign-input" placeholder="Введите отчество">
        </p>
        @foreach ($errors->get('patronymic') as $error)
            <p class="error">
                {{$error}}
            </p>
        @endforeach
        <p>
            <label for="email">Адрес эл. почты</label>
            <input id="email" name="email" type="text" class="sign-input" placeholder="Введите адрес эл. почты">
        </p>
        @foreach ($errors->get('email') as $error)
            <p class="error">
                {{$error}}
            </p>
        @endforeach
        <p>
            <label for="login">Логин</label>
            <input id="login" name="login" type="text" class="sign-input" placeholder="Введите логин">
        </p>
        @foreach ($errors->get('login') as $error)
            <p class="error">
                {{$error}}
            </p>
        @endforeach
        <p>
            <label for="password">Пароль</label>
            <input id="password" name="password" type="password" class="sign-input" placeholder="Введите пароль">
        </p>
        @foreach ($errors->get('password') as $error)
            @if ($error !== 'Поле подтверждения пароля не совпадает')
                <p class="error">
                    {{$error}}
                </p>
            @endif
        @endforeach
        <p>
            <label for="password_confirmation">Подтверждение пароля</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="sign-input" placeholder="Введите пароль">
        </p>
        @foreach ($errors->get('password') as $error)
            @if ($error == 'Поле подтверждения пароля не совпадает')
                <p class="error">
                    {{$error}}
                </p>
            @endif
        @endforeach
        <p>
            <input type="submit" value="Зарегистрироваться"  class="sign-input sign-button button-create">
        </p>
        <p>
            Вы уже регистрировались? <a href="{{route('signin')}}" class="link-blue">Вход</a>
        </p>
    </form>
@endsection
