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
                    <div class="row justify-content-around radius p-2 border mb-3">
                        <div class="col-sm-3 text-center">
                            <p class="h3 mt-2 p-2 radius btn-info quiz text-white" onclick="goToLogin();"> {{$cat->category_name}}</p>
                        </div>
                        <div class="col-5 text-center radius bg-info text-white desc">
                            <span >{{$cat->description}}</span>
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

