@extends('wrap')
@section('title','Личный кабинет')
@section('content')
<div class="profile-grig">
    <div class="profile-block profile-block-center">
        <div class="profile-logo">
            @if ((isset(Auth::user()->photo)))
                <img src="{{asset('public/storage/'.Auth::user()->photo)}}" alt="Иконка профиля">
            @else
                <img src="{{asset('public/img/static/default.jfif')}}" alt="Иконка профиля">
            @endif
        </div>
        <div>
            {{Auth::user()->first_name}} {{Auth::user()->last_name}}
        </div>
        <div>
            Всего пройдено опросов:
        </div>
        <hr class="margin" style="width: 100%">
        <button class="button-form button-profile">
            Изменить пароль
        </button>
        <button class="button-form button-profile">
            Изменить фото
        </button>
        <button class="button-form button-profile">
            Изменить тему
        </button>
        <button class="button-delete button-profile" onclick="openPopup('-logout')">
            Выйти из аккаунта
        </button>
    </div>
    {{-- <div class="profile-block profile-block-center">
        <h1>
            Изменение пароля профиля
        </h1>
        <form action="{{route('passwordpatch')}}" method="POST" class="popup-form-a">
            @method('PATCH')
            @csrf
            <p>
                <label for="current_password">Введите старый пароль:</label>
                <input type="password" name="current_password" id="current_password">
            </p>
            @foreach ($errors->get('password') as $error)
                @if ($error == 'Введен неверный пароль')
                    <p class="error">
                        {{$error}}
                    </p>
                @endif
            @endforeach
            <p>
                <label for="password">Введите новый пароль:</label>
                <input type="password" name="password" id="password">
            </p>
            @foreach ($errors->get('password') as $error)
                @if ($error !== 'Поле подтверждения пароля не совпадает' && $error !== 'Введен неверный пароль')
                    <p class="error">
                        {{$error}}
                    </p>
                @endif
            @endforeach
            <p>
                <label for="">Повторите новый пароль:</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </p>
            @foreach ($errors->get('password') as $error)
                @if ($error == 'Поле подтверждения пароля не совпадает')
                    <p class="error">
                        {{$error}}
                    </p>
                @endif
            @endforeach
            <button class="button-create">
                Изменить
            </button>
        </form>
    </div> --}}
    <div class="profile-block profile-block-center">
        <h1>
            Изменение фотографии профиля
        </h1>
        <form action="{{route('photopatch')}}" method="POST" enctype="multipart/form-data" class="popup-form-a">
            @method('PATCH')
            @csrf
            <div class="profile-logo auto">
                <img src="{{asset('public/img/static/default.jfif')}}" alt="Иконка профиля" id="previewImage">
            </div>
            <label for="photo">Изображение</label>
            <input id="photo" name="photo" type="file" class="sign-input">
            @foreach ($errors->get('photo') as $error)
                <p class="error">
                    {{$error}}
                </p>
            @endforeach
            <button class="button-create">
                Изменить
            </button>
        </form>
    </div>
</div>
@endsection
