<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>IT-CUBE | @yield('title')</title>
        <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
        <link rel="shortcut icon" href="{{asset('public/img/static/logo.ico')}}" type="image/x-icon">
    </head>
    <body>
        <div class="message">
            ghbdtn
        </div>
        <div id="overlay" class="overlay"></div>
        <div id="popup" class="popup popup-logout">
            <div class="popup-menu-block">
                <h1>Подтвердите выход из аккаунта</h1>
                Вы уверины что хотите выйти из аккаунта?
            </div>

            <div class="popup-menu-block popup-menu-block-button">
                <div>
                    <button onclick="closePopup('-logout')" class="popup-button button-cancel popup-menu-button">Отменить</button>
                </div>
                <div>
                    <a href="{{route('logout')}}">
                        <button class="popup-button button-delete popup-menu-button">Выйти</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="wrap">
            <header>
                    <div class="header">
                        <div>
                            <a href="{{route('home')}}" class="logo">Мой опрос</a>
                        </div>
                        <div class="naw">
                            @auth
                                @if (isset($data['naw']))
                                    @if(Auth::user()->role== 'admin')
                                        <a href="{{route('index')}}" class="naw-a {{isset($data['active'])&&$data['active']=='form'?'nav-active':''}}">Опросы</a>
                                        <a href="{{route('indeximage')}}" class="naw-a {{isset($data['active'])&&$data['active']=='image'?'nav-active':''}}">Темы</a>
                                    @else

                                    @endif
                                @endif
                            @endauth
                        </div>
                        <div>
                                @auth
                                    <div class="menu">
                                        <div class="menu-logo btn-menu-open pointer">
                                            @if ((isset(Auth::user()->photo)))
                                                <img src="{{asset('public/storage/'.Auth::user()->photo)}}" alt="Иконка профиля">
                                            @else
                                                <img src="{{asset('public/img/static/default.jfif')}}" alt="Иконка профиля">
                                            @endif
                                        </div>
                                        <div class="menu-window">
                                            <div class="menu-logo btn-menu-close">
                                                <img src="{{asset('public/img/static/close.png')}}" alt="Иконка профиля">
                                            </div>
                                            <div class="menu-window-info">
                                                <div class="menu-logo">
                                                    <a href="{{route('profile')}}">
                                                        @if ((isset(Auth::user()->photo)))
                                                            <img src="{{asset('public/storage/'.Auth::user()->photo)}}" alt="Иконка профиля">
                                                        @else
                                                            <img src="{{asset('public/img/static/default.jfif')}}" alt="Иконка профиля">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div>
                                                    <h3 class="bold">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h3>
                                                    <p class="margin-0">{{Auth::user()->email}}</p>
                                                </div>
                                            </div>
                                            <a href="{{route('profile')}}">
                                                <div class="btn-menu">
                                                    {{ __('Личный кабинет')}}
                                                </div>
                                            </a>
                                            @if (Auth::user()->role==='admin')
                                            <a href="{{route('index')}}">
                                                <div class="btn-menu">
                                                    {{ __('Админ панель')}}
                                                </div>
                                            </a>
                                            @endif
                                            <a href="/profile">
                                                <div class="btn-menu">
                                                    {{ __('Мои отклики')}}
                                                </div>
                                            </a>
                                            <hr class="margin" style="width: 100%">
                                            <p class="btn-menu pointer" onclick="openPopup('-logout')">{{ __('Выйти из аккаунта')}}</p>

                                        </div>
                                    </div>
                                @endauth
                                @guest
                                    <div class="menu">
                                        <a href="{{route('signin')}}" class="naw-a"><button class="share-block signin-button"><img class="share-img" src="{{asset('public/img/static/signin.png')}}" alt=""><div>Войти</div></button></a>
                                    </div>
                                @endguest
                        </div>
                    </div>
            </header>
            <div class="main">
                <div class="content">
                    @guest
                        <div class="background" style="background-image: url('{{asset('public/img/static/theme.jpg')}}')">

                        </div>
                    @endguest
                    @auth
                        @if ((isset(Auth::user()->theme)))
                            <div class="background" style="background-image: url('{{asset('public/storage/'.Auth::user()->theme->image->path)}}')">

                            </div>
                        @else
                            <div class="background" style="background-image: url('{{asset('public/img/static/theme.jpg')}}')">

                            </div>
                        @endif
                    @endauth
                    @yield('content')
                </div>
            </div>
            @if (isset($data['footer']))
                <footer>
                    <div class="content">
                        <div class="footer">
                            <div>
                                <h2>Адрес</h2>
                                <hr>
                                <p>
                                    г. Магнитогорск, пр-т Ленина, д. xx, корп. x, этаж x.
                                </p>
                            </div>
                            <div>
                                <h2>Контакты</h2>
                                <hr>
                                <p>
                                    <a href="tel:+79999999999">+7&nbsp;(xxx)&nbsp;xxx-xx-xx</a>
                                </p>
                                <p>
                                    <a href="mailto:mailcube@yandex.ru">xxxxxxxx@yandex.ru</a>
                                </p>
                            </div>
                            <div>
                                <h2>Социальные сети</h2>
                                <hr>
                                <p>
                                    <div class="share-img">
                                        <a href="https://vk.com/">
                                            <img class="" alt="" src="{{asset('public/img/static/vk.webp')}}">
                                        </a>
                                    </div>
                                </p>
                            </div>
                        </div>
                        <div class="footer-two">
                            © 2024 - 2024  Все права защищены
                        </div>
                    </div>
                </footer>
            @endif
        </div>
    </body>
    <script src="{{asset('public/js/script.js')}}"></script>
    @auth
        <script src="{{asset('public/js/user.js')}}"></script>
        @if (Auth::user()->role==='admin')
            <script src="{{asset('public/js/admin.js')}}"></script>
        @endif
    @endauth

    <script>
        @if (session('success'))
            messagePopup('{{session('success')}}','success');
        @endif
        @if (session('error'))
            messagePopup('{{session('error')}}','error');
        @endif
    </script>
</html>
