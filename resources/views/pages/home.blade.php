@extends('layouts.master')
@section('header')
    <div class="d-flex flex-nowrap justify-content-between">
        <div class="card-header h4 fixed-top ">
            <a href="{{route('home')}}" class="navbar-brand text-info text-left">ICT Expert QUIZ</a>
            @if(!session()->has('user'))
                <div class="float-right">
                    <a href="{{route('log-reg')}}"  class="btn btn-outline-info text-center" >Prijavi se </a>
                    <a href="{{route('log-reg', ['reg' => 1])}}" class="btn btn-outline-info text-center" > Registruj se</a>
                </div>
            @else
                <div class="move d-inline-block">
                    @foreach($categories as $cat)
                    <a href="{{route('quiz', ['category' => $cat->id])}}"  class="btn btn-outline-info mr-3" >{{$cat->category_name}}</a>
                    @endforeach
                    {{--<p class="h6">{{session()->get('user')->first_name }} {{session()->get('user')->last_name}}</p>--}}
                    {{--<img class="img" src="{{asset('/')}}images/{{session()->get('user')->image_name}}"  alt="{{substr(session()->get('user')->image_name,15,30)}}">--}}
                </div>
                <a href="{{route('logout')}}"  class="btn btn-outline-info float-lg-right" >Odjavi se</a>
            @endif
        </div>
        @endsection
        @section('content')
            <div class="row justify-content-center">
                <div class="container">

                </div>
            </div>
    </div>

@endsection
@section('functions')
    <script src="{{asset("/")}}js/functions.js"></script>
@endsection
