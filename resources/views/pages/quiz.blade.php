@extends('layouts.master')

@foreach($quiz as $key => $data)

    {{$data->question}}


@section('header')
    <div class="w-100 bg-info text-white">
            <div class="d-flex p-1 justify-content-xl-around">
                <div class="d-flex justify-content-lg-start">
                    <img src="{{asset('/')}}images/{{session()->get('user')->image_name}}"  alt="{{substr(session()->get('user')->image_name,15,30)}}" title="{{session()->get('user')->first_name }}">
                    <a title="Moj profil" href="{{route('profile-show',['id' => session()->get('user')->id])}}" class="navbar-brand text-white ml-3">{{session()->get('user')->first_name }} {{session()->get('user')->last_name}}</a>
                </div>
            <span class="h2 text-white mt-1">{{$data->category->category_name}}</span>
            <a href="{{route('logout')}}" class="btn btn-outline-dark h5 mt-1 text-center text-white">Odjavi se</a>
        </div>
    </div>
@endsection
@section('content')

    <div class="container w-50 p-3">
        @foreach($quiz as $key2 => $data2)
        <div class="card">
            <div class="card-header d-flex justify-content-center h4 bg-info text-white">
                <span class="text-center">{{$data2->question}}</span>
            </div>
            <div class="card-body d-inline-flex justify-content-center ">
                <span>
                   @foreach($data->answers as $key1 => $data1)
                    <label for="{{substr($data->answer_text,0,10)}}">{{$data->answer_text}}</label>
                    <input type="radio" name="{{$data->question}}" class="form-control" id="{{substr($data1->answer_text,0,10)}}">
                    @endforeach
                </span>
            </div>
        </div>
        @endforeach
    </div>
@endsection
@endforeach
