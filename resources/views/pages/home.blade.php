@extends('layouts.master')
<div id="container">
@section('header')
    @if(!session()->has('user'))
        <div class="d-flex p-1  justify-content-around bg-dark">
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
            <a href="{{route('index')}}" class="mr-5 navbar-brand text-left text-white">ICT Expert QUIZ</a>
            <a href="{{route('logout')}}" class="ml-5 btn btn-outline-info h5 mt-1 text-center text-white">Odjavi se</a>
        </div>

    @endif
        <div class="border-top">
            <p class="text-center h5 text-white bg-info p-1">Odaberite željenu kategoriju </p>
        </div>
@endsection
@section('content')
    <div class="container mb-5 mt-3">
        @foreach($categories as $cat)
        <div class="row justify-content-around radius p-2 border mb-3">
                <div class="col-sm-3 text-center">
                    @if(session()->has('user'))
                    <p class="h3 mt-2 p-2 radius btn-info quiz text-white" data-category-token="{{$cat->category_token}}" data-category-name="{{$cat->category_name}}" data-category="{{$cat->id}}" data-user="{{session()->get('user')->id}}" >{{$cat->category_name}}</p>
                    @else
                    <p class="h3 mt-2 p-2 radius btn-info quiz text-white" onclick="goToLogin();"> {{$cat->category_name}}</p>
                    @endif
                </div>
            <div class="col-5 text-center radius bg-info text-white desc ">
                <span >{{$cat->description}}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('functions')
    <script src="{{asset("/")}}js/functions.js"></script>
@endsection
@section('scripts')
    <script src="{{asset("/")}}js/quizRouting.js"></script>
    @if(session()->has('error'))
        <script type="text/javascript">
            bootbox.alert({
                message: "Test je još uvek u pripremi!",
                small: 'small',
                buttons : {
                    ok: {
                        label : 'U redu',
                        className : 'btn-info'
                    }
                }
            });
        </script>
    @endif
@endsection

