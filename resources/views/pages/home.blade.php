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
        <div class="row justify-content-around radius p-2 border mb-3">
                <div class="col-sm-3 text-center">
                    @if(session()->has('user'))
                    <p class="h3 mt-2 p-2 radius btn-info quiz text-white" data-category-token="{{$cat->category_token}}" data-category-name="{{$cat->category_name}}" data-category="{{$cat->id}}" data-user="{{session()->get('user')->id}}" >{{$cat->category_name}}</p>
                    @else
                    <p class="h3 mt-2 p-2 radius btn-info quiz text-white" onclick="goToLogin();"> {{$cat->category_name}}</p>
                    @endif
                </div>
            <div class="col-5 text-center radius bg-info text-white desc">
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
