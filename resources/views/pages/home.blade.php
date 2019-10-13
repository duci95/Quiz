@extends('layouts.master')
<div id="container">
@section('header')
    @if(!session()->has('user'))
        @include('partials.header-null')
    @else
        @include('partials.header')
    @endif
        <div class="border-top">
            <p class="text-center h5 text-white bg-info p-1">Odaberi željenu kategoriju </p>
        </div>
@endsection
@section('content')
    <div class="container mb-5 mt-3">
        @foreach($categories as $cat)
           @if(session()->has('user'))
                @if(session()->get('user')->role_id === 2 )
                    @include('partials.moderator-content')
                @elseif(session()->get('user')->role_id === 1)
                    @include('partials.administrator-content')
                @elseif(session()->get('user')->role_id === 3)
                    @include('partials.tester-content')
                @endif
            @else
                    <div class="row justify-content-around radius p-2 border mb-3">
                        <div class="col-sm-3 text-center">
                            <p class="h3 mt-2 p-2 radius btn-info quiz text-white" onclick="goToLogin();"> {{$cat->category_name}}</p>
                        </div>
                        <div class="col-5 text-center radius bg-info text-white desc">
                            <span >{{$cat->description}}</span>
                        </div>
                    </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
@section('functions')
    <script src="{{asset("/")}}js/functions.js"></script>
@endsection

