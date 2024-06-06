@extends('wrap')
@section('title','Опросы')
@section('content')
    @foreach($data['form'] as $key =>$value)
        <div class="display-form">
            <div>
                <a href="{{route('showform',['form'=>$value['id']])}}" class="a-no">
                    <img src="{{asset('public/storage/'.$value['preview'])}}" alt="" class="shadow scale">
                </a>
            </div>
            <div>
                <a href="{{route('showform',['form'=>$value['id']])}}" class="a-no">
                    <h1 class="scale">
                        {{$value['title']}}
                    </h1>
                </a>
                <div>
                    {{$value['description']}}
                </div>
            </div>
        </div>
    @endforeach
    <div class="center">
        {{ $data['paginate']->links('pagination') }}
    </div>
@endsection
