@extends('wrap')
@section('title','Форма '.$data['title'])
@section('content')
    <h1>
        Форма - {{$data['title']}}
    </h1>
    <table>
        @foreach($data['questionnaires'] as $key =>$value)
            <thead>
                <tr class="form-title">
                    <th colspan="2"><h2 class="center">Анкета №{{$value['id']}}</h2></th>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th class="form-question"><h2>Вопрос</h2></th>
                    <th class="form-question"><h2>Ответ</h2></th>
                </tr>
            </thead>
            <tbody>
                @foreach($value['answers'] as $key1 =>$value1)
                    <tr>
                        <th>{{$value1['question']}}</th>
                        <th>{{$value1['answer']}}</th>
                    </tr>
                @endforeach
            <tbody>
        @endforeach
    </table>
@endsection
