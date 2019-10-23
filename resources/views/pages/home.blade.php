@extends('layouts.master')
<div id="container">
@section('header')
    @if(!session()->has('user'))
        @include('partials.header-null')
    @else
        @include('partials.header')
    @endif
@endsection
@section('content')
    <div class="container mb-5 mt-3">
           @if(session()->has('user'))
                @if(session()->get('user')->role_id === 2)
                    @include('pages.moderator-categories')
                @elseif(session()->get('user')->role_id === 1)
                    @include('pages.administrator-content')
                @elseif(session()->get('user')->role_id === 3)
                    @include('pages.tester-content')
                @endif
            @else
               @foreach($categories as $cat)
                    <div class="row justify-content-sm-around p-1 border-top border-bottom mb-3">
                        <div class="row col-3 justify-content-center">
                            <span class="p-2 btn-info quiz badge text-white" onclick="goToLogin();"> {{$cat->category_name}}</span>
                        </div>
                        <div class="col-5 row justify-content-center align-content-center">
                            <span class="p-2 btn btn-info quiz badge text-white" >{{$cat->description}}</span>
                        </div>
                    </div>

               @endforeach
            @endif
    </div>
</div>
@endsection
@section('functions')
    <script src="{{asset("/")}}js/functions.js"></script>
@endsection