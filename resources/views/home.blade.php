@extends('wrap')
@section('title','Главная страница')
@section('content')
    <div class="banner">
        <img src="{{asset('public/img/static/banner1.png')}}" alt="">
        <div class="banner-block">
            <pre><h1 class="banner-text">Быстрые опросы и
тесты. Проходи уже
сегодня</h1></pre>
            <a href="{{route('indexfrom')}}">
                <button class="sign-button button-form banner-button">
                    <div class="white">
                        Попробовать
                    </div>
                    <img class="share-img" src="{{asset('public/img/static/arrow-right.png')}}" alt="">
                </button>
            </a>
        </div>
    </div>

@endsection
