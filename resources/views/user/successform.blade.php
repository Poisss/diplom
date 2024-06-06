@extends('wrap')
@section('title',$data['title'])
@section('content')
    <div class="success-block">
        <h1>Спасибо!</h1>
        <p>Ваше отклик отправлен.</p>
        <a href="{{route('showform',['form' => $data['id']])}}">
            <div class="repeat">
                <div class="repeat-img">
                    <img src="{{asset('public/img/static/repeat.png')}}" alt="">
                </div>
                <div>
                    Заполнить опрос ещё раз
                </div>
            </div>
        </a>
    </div>
    <p></p>
    <div class="success-block share">
        <div>
            <h2>Поделиться опросом</h2>
        </div>
        <div class="share-block">
            <div>
                <a href="https://telegram.me/share/url?url={{route('showform',['form' => $data['id']])}}">
                    <img class="share-img" src="{{asset('public/img/static/tg.png')}}" alt="tg">
                </a>
            </div>
            <div>
                <a href="https://vk.com/share.php?url={{route('showform',['form' => $data['id']])}}">
                    <img class="share-img" src="{{asset('public/img/static/vk.png')}}" alt="vk">
                </a>
            </div>
            <div class="copys" onclick="copy()">
                <input class="copy-value" type="hidden" value="{{route('showform',['form' => $data['id']])}}">
                <img class="share-img" src="{{asset('public/img/static/copy.png')}}" alt="">
            </div>
        </div>
    </div>
@endsection
