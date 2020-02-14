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
                    <div class="row justify-content-sm-between m-auto p-2 border-top border-bottom mb-3 w-75">
                        <div class="row col-3 w-100">
                            <span class="p-2 btn-info quiz badge text-white w-100" onclick="goToLogin();"> {{$cat->category_name}}</span>
                        </div>
                        <div class="col-8">
                            <span class="p-2 badge badge-info text-white w-100 text-left pl-5" >{{$cat->description}}</span>
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
