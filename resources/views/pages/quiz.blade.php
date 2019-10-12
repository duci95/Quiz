@extends('layouts.master')
@foreach($quiz as $key => $data)
@section('header')
    <div class="w-100 bg-info text-white fixed-top">
            <div class="d-flex p-1 justify-content-around">
                <div class="d-flex justify-content-start">
                    <img src="{{asset('/')}}images/{{session()->get('user')->image_name}}"  alt="{{substr(session()->get('user')->image_name,15,30)}}" title="{{session()->get('user')->first_name }}">
                    <a title="Moj profil" href="{{route('profile-show',['id' => session()->get('user')->id])}}" class="navbar-brand text-white ml-3 mt-1">{{session()->get('user')->first_name }} {{session()->get('user')->last_name}}</a>
                </div>
            <span  id="category" data-category="{{$data->category->id}}" class="h2 text-white mt-1 move-left">{{$data->category->category_name}}</span>
            <a href="{{route('logout')}}" class="ml-5 btn btn-outline-dark h5 mt-1 text-center text-white">Odjavi se</a>
        </div>
        <p id="demo" class="text-white text-center h5 time bg-success m-0 p-1 margin-header-bottom">20:00</p>
    </div>
@endsection
@endforeach
@section('content')
    <div class="container w-50 p-1 cards-margin mb-5">
        @foreach($quiz as $questionNo => $questions)
        <div class="card m-3">
            <div class="card-header h5 p-1 text-center bg-info text-white">
                <span class="float-left pl-4">{{$questionNo+1}}.</span>
                <input type="hidden" name="questions[]" value="{{$questions->id}}"/>
                <span  class="text-center">{{$questions->question}} ?</span>
            </div>
            <div class="card-body p-0">
                   @foreach($questions->answers as $answersNo => $answers)
                               <div class="justify-content-around pl-3 p-0 radio">
                                   <input type="radio"  name="{{$questions->question}}[]" class="mt-2" id="{{substr($answers->answer,0,10)}}" value="{{$answers->id}}"/>
                                   <label for="{{substr($answers->answer,0,10)}}">{{$answers->answer}} </label>
                               </div>
                    @endforeach
            </div>
        </div>
        @endforeach
        <button id="validate" class="justify-content-center btn btn-success d-flex m-auto text-uppercase">Predaj test</button>
    </div>
@endsection
@section('functions')
    <script src="{{asset("/")}}js/functions.js"></script>
@endsection
@section('scripts')
    <script src="{{asset("/")}}js/quizValidate.js"></script>
@endsection
