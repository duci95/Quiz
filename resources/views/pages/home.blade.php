@extends('layouts.master')
@section('header')
    @if(!session()->has('user'))
        <div class="d-flex p-1 justify-content-around bg-dark">
            <a href="{{route('index')}}" class="navbar-brand text-white">ICT Expert QUIZ</a>
            <div class="justify-content-center">
                <a href="{{route('log-reg')}}"  class="btn text-white ml-2 btn-outline-info" >Prijavi se </a>
                <a href="{{route('log-reg', ['reg' => 1])}}" class= "btn ml-3 text-white btn-outline-info"> Registruj se</a>
            </div>
        </div>
    @else
        <div class="d-flex p-1 justify-content-xl-around bg-dark">

            <div class="d-flex justify-content-lg-start">
                <img src="{{asset('/')}}images/{{session()->get('user')->image_name}}"  alt="{{substr(session()->get('user')->image_name,15,30)}}" title="{{session()->get('user')->first_name }}">
                <a title="Moj profil" href="{{route('profile-show',['id' => session()->get('user')->id])}}" class="navbar-brand text-white ml-3">{{session()->get('user')->first_name }} {{session()->get('user')->last_name}}</a>
            </div>
            <a href="{{route('index')}}" class="navbar-brand text-left text-white">ICT Expert QUIZ</a>
            <a href="{{route('logout')}}" class="btn btn-outline-info h5 mt-1 text-center text-white">Odjavi se</a>
        </div>
        <div class="border-top">
            <p class="text-center h5 text-white bg-info p-1">Odaberite željenu kategoriju </p>
        </div>
    @endif
@endsection
@section('content')
    <div class="container mb-5">
        @foreach($categories as $cat)
        <div class="row justify-content-around radius border p-1 mb-3">
                <div class="col-sm-3 categories mb-1">
                    <button  class="btn h2 p-3 btn-info quiz text-white" data-category="{{$cat->id}}" data-user="{{session()->get('user')->id}}" data-toggle="modal" data-target="#quizModalSuccess">{{$cat->category_name}}</button>
                </div>
            <div class="col-sm-5 desc text-center radius text-info">
                <p class="pt-3">{{$cat->description}}</p>
            </div>
        </div>
        @endforeach
    </div>
@endsection
@section('scripts')
    <script src="{{asset("/")}}js/quizRouting.js"></script>
@endsection
