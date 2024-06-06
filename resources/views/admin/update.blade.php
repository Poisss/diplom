@extends('wrap')
@section('title','Изменение формы')
@section('content')
    <h1>{{$data['title']}}</h1>
        <div class="form-create-header">
            <div>
                <a href="">
                    Конструктор
                </a>
            </div>
            <div>
                <a href="">
                    Тема
                </a>
            </div>
            <div>
                <a href="">
                    Настройки
                </a>
            </div>
            <div>
                <button>
                    Предпросмотр
                </button>
            </div>
            <div>
                <button>Опубликовать форму</button>
            </div>
        </div>
        <div class="page-list">
            <div class="form-view">
                @foreach ($data['page'] as $index => $item1)
                    <div class="page-question">
                        <div class="page-question-header">
                            <div>
                                Страница {{$index+1}} из {{count($data['page'])}}
                            </div>
                            <div class="page-question-delete" onclick="openPopup('-delete-page-{{$index+1}}')">
                                <img class="delete-button" src="{{asset('public/img/static/delete.svg')}}" alt="">
                            </div>
                            <div id="popup" class="popup popup-delete-page-{{$index+1}}">
                                <div class="popup-menu-block">
                                    <h1>Подтвердите удаление</h1>
                                    Вы уверины что хотите удалить страницу?
                                </div>
                                <div class="popup-menu-block popup-menu-block-button">
                                    <div>
                                        <button onclick="closePopup('-delete-page-{{$index+1}}')" class="popup-button button-cancel popup-menu-button">Отменить</button>
                                    </div>
                                    <div>
                                        <form action="{{route('destroypage',["page"=>$item1['id']])}}" method="POST" class="popup-form">
                                            @method('DELETE')
                                            @csrf
                                            <button class="popup-button button-delete popup-menu-button">Удалить</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($item1['questions'] as $item)
                            <div>

                            </div>
                        @endforeach
                    </div>
                <div class="button-form button-page page-question-end" onclick="openPopup('-create-question-{{$index+1}}')">
                    Добавить вопрос
                </div>
                @endforeach
            </div>
        </div>
        <form action="{{route('storepage')}}" method="POST" class=" popup-form-a">
            @method('POST')
            @csrf
            <input type="hidden" name="form_id" value="{{$data['id']}}">
            <button class="button-form button-page">
                Добавить страницу
            </button>
        </form>
@endsection
