@extends('layouts.master')
@foreach($quiz as $key => $data)
@section('header')
    <div class="w-100 bg-info text-white">
            <div class="d-flex p-1 justify-content-around">
                <div class="d-flex justify-content-start">
                    <img src="{{asset('/')}}images/{{session()->get('user')->image_name}}"  alt="{{substr(session()->get('user')->image_name,15,30)}}" title="{{session()->get('user')->first_name }}">
                    <a title="Moj profil" href="{{route('profile-show',['id' => session()->get('user')->id])}}" class="navbar-brand text-white ml-3">{{session()->get('user')->first_name }} {{session()->get('user')->last_name}}</a>
                </div>
            <span class="h2 text-white mt-1 mr-5">{{$data->category->category_name}}</span>
            <a href="{{route('logout')}}" class="ml-5 btn btn-outline-dark h5 mt-1 text-center text-white">Odjavi se</a>
        </div>
    </div>

    <p id="demo"></p>
@endsection
@endforeach
@section('content')
    <div class="container w-50">
        @foreach($quiz as $questionNo => $questions)
        <div class="card m-3">
            <div class="card-header h5 p-1 text-center bg-info text-white">
                <span class="float-left pl-4">{{$questionNo+1}}. </span>
                <span class="text-center">{{$questions->question}} ?</span>
            </div>
            <div class="card-body p-0 text-center">
                   @foreach($questions->answers as $answersNo => $answers)
                        <label class="ml-3 pt-2" for="{{substr($answers->answer_text,0,10)}}">{{--{{$answersNo + 1}}. --}}{{$answers->answer_text}} </label>
                        <input type="radio" name="{{$questions->question}}" class="mr-3" id="{{substr($answers->answer_text,0,10)}}" value="{{$answers->true}}" />
                    @endforeach
            </div>
        </div>
        @endforeach
    </div>
@endsection
@section('functions')
    <script src="{{asset("/")}}js/functions.js"></script>
@endsection
@section('scripts')
    <script src="{{asset("/")}}js/quizValidate.js"></script>
@endsection
