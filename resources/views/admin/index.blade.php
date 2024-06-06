@extends('wrap')
@section('title','Формы')
@section('content')
    <p>
        <button onclick="openPopup('-create')" class="button-create">Создать опрос</button>
    </p>
    <div class="popup popup-menu popup-create">
        <form action="{{route('store')}}" method="POST" class="popup-form-a" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="popup-menu-block">
                <h1>Создание опроса</h1>
            </div>
            <div class="popup-menu-block">
                <p>
                    <label for="title">Название</label>
                    <input id="title" name="title" type="text"  class="sign-input"  placeholder="Введите название">
                </p>
                @foreach ($errors->get('title') as $error)
                    <p class="error">
                        {{$error}}
                    </p>
                @endforeach
                <p>
                    <label for="title">Превью</label>
                    <input id="preview" name="preview" type="file"  class="sign-input">
                </p>
                @foreach ($errors->get('title') as $error)
                    <p class="error">
                        {{$error}}
                    </p>
                @endforeach
                <p>
                    <label for="description">Описание</label>
                    <textarea name="description" id="description"></textarea>
                </p>
                @foreach ($errors->get('description') as $error)
                    <p class="error">
                        {{$error}}
                    </p>
                @endforeach
            </div>
            <div class="popup-menu-block popup-menu-block-button">
                <div onclick="closePopup('-create')" class="popup-button button-grye button-cancel popup-menu-button">
                    Назад
                </div>
                <button class="button-create popup-menu-button">
                    Создать
                </button>
            </div>
        </form>
    </div>
    <table>
        <thead>
            <tr>
              <th>Название</th>
              <th>Фон</th>
              <th>Доступ</th>
              <th>Дата создания</th>
              <th>Действие</th>
            </tr>
          </thead>
        <tbody>
            @foreach($data['form'] as $key =>$value)
                <tr>
                    <th>{{$value['title']}}</th>
                    <th><img src="{{asset('public/storage/'.$value['background'])}}" alt="" style="width: 200px; display: inline; "></th>
                    <th>{{$value['access']}}</th>
                    <th>{{$value['created_at']}}</th>
                    <th>
                        <div class="flex">
                            <a class="button-a" href="{{route('show',['form' => $value['id']])}}"><button class="button-form width-100">Посмотреть</button></a>
                            <a class="button-a" href="{{route('edit',['form' => $value['id']])}}"><button class="button-form width-100">Изменить</button></a>
                            <button onclick="openPopup('-access-{{$value['id']}}')" class="button-form width-100">Изменить доступ</button>
                            <a class="button-a" href="{{route('export',['form' => $value['id']])}}"><button class="button-form width-100">Скачать</button></a>
                            <button onclick="openPopup({{$value['id']}})" class="button-delete">Удалить</button>
                        </div>

                        <div id="popup" class="popup popup-access-{{$value['id']}}">
                            <div class="popup-menu-block">
                                <h1>Изменение доступа</h1>
                            </div>
                            <form action="{{route('patch',['form' => $value['id']])}}" method="POST" class="popup-form-a">
                                @method('PATCH')
                                @csrf
                                <div class="popup-menu-block">
                                    Выберите доступ:
                                    <select name="access" id="" class="select-access">
                                        @if ($value['access']=='доступен')
                                            <option value="недоступен">недоступен</option>
                                            <option value="по ссылке">по ссылке</option>
                                        @elseif($value['access']=='недоступен')
                                            <option value="доступен">доступен</option>
                                            <option value="по ссылке">по ссылке</option>
                                        @else
                                            <option value="доступен">доступен</option>
                                            <option value="недоступен">недоступен</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="popup-menu-block popup-menu-block-button">
                                    <div onclick="closePopup('-access-{{$value['id']}}')" class="popup-button button-grye button-cancel popup-menu-button">Назад</div>
                                    <button class="popup-button button-form popup-menu-button">Подтвердить</button>
                                </div>
                            </form>
                        </div>

                        <div id="popup" class="popup popup{{$value['id']}}">
                            <div class="popup-menu-block">
                                <h1>Подтвердите удаление</h1>
                                Вы уверины что хотите удалить форму?
                            </div>
                            <div class="popup-menu-block popup-menu-block-button">
                                <div>
                                    <button onclick="closePopup({{$value['id']}})" class="popup-button button-cancel popup-menu-button">Отменить</button>
                                </div>
                                <div>
                                    <form action="{{route('destroy',['form' => $value['id']])}}" method="POST" class="popup-form">
                                        @method('DELETE')
                                        @csrf
                                        <button class="popup-button button-delete popup-menu-button">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            @endforeach
        <tbody>
    </table>
    <div class="center">
        {{ $data['paginate']->links('pagination') }}
    </div>
@endsection
