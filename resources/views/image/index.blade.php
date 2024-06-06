@extends('wrap')
@section('title','Изображения')
@section('content')
    <div id="overlay" class="overlay"></div>
    <p>
        <a class="button-a" href="{{route('createimage')}}"><button class="button-create">Добавить изображение</button></a>
    </p>
    <table>
        <thead>
            <tr>
              <th>Название</th>
              <th>Картинка</th>
              <th>Действие</th>
            </tr>
          </thead>
        <tbody>
            @foreach($data['image'] as $key =>$value)
                <tr>
                    <th>{{$value['name']}}</th>
                    <th><img src="{{asset('public/storage/'.$value['path'])}}" style="width: 300px" alt=""></th>
                    <th>
                        <button onclick="openPopup({{$value['id']}})" class="button-delete">Удалить</button>
                        <div id="popup" class="popup popup{{$value['id']}}">
                            <h1>Подтвердите удаление</h1>
                            <p>Вы уверины что хотите удалить изображение?</p>
                            <div class="popup-block">
                                <div>
                                    <button onclick="closePopup({{$value['id']}})" class="popup-button button-cancel">Отменить</button>
                                </div>
                                <div>
                                    <form action="{{route('destroyimage',['image' => $value['id']])}}" method="POST" class="popup-form">
                                        @method('DELETE')
                                        @csrf
                                        <button class="popup-button button-delete">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            @endforeach
        <tbody>
    </table>
@endsection
