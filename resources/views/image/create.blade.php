@extends('wrap')
@section('title','Добавление изображения')
@section('content')
    <form action="{{route('storeimage')}}" method="POST" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <h1>Добавление изображения</h1>
        <p>
            <label for="name">Название</label>
            <input id="name" name="name" type="text" class="sign-input">
            @foreach ($errors->get('name') as $error)
                <p class="error">
                    {{$error}}
                </p>
            @endforeach
        </p>
        <p>
            <label for="image">Изображение</label>
            <input id="image" name="image" type="file" class="sign-input">
            @foreach ($errors->get('image') as $error)
                <p class="error">
                    {{$error}}
                </p>
            @endforeach
        </p>
        <p>
            <input type="submit" value="Добавить"  class="sign-input">
        </p>
    </form>
@endsection
