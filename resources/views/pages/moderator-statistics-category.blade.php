@extends('layouts.master')
@section('header')
    @include('partials.header')
        <div class="d-flex justify-content-center bg-info text-white p-1">{{$users[0]->category_name}}</div>
    @endsection
@section('content')
<div class="content container">
@foreach($users as $u)
    <div class="row border-bottom justify-content-center border-top  m-2">
        <span class="row justify-content-start col-2">
            <img src="{{asset('/images/')}}/{{$u->image_name}}" alt="{{substr($u->image_name,0,10)}}" title="{{substr($u->image_name,0,10)}}">
        </span>
        <span class="row justify-content-start col-5 align-content-center">
            <a href="{{route('statistics-user',['id' => $u->user_id])}}" class="badge text-white p-2 btn btn-info mr-3">{{$u->first_name}} {{$u->last_name}}</a>
            <span class="badge p-2 btn-primary">{{$u->email}}</span>
        </span>
        <span class="row justify-content-end col-5 align-content-center">
            @if($u->trues >= $questions[0]->questions/2)
            <span class=" badge p-2 btn-success text-uppercase">položen</span>
            @else
            <span class=" badge p-2 btn-danger text-uppercase">Nije položen</span>
            @endif
        </span>
    </div>
@endforeach
    <span class="d-flex justify-content-center">
            {{$users->links()}}
        </span>
</div>
@endsection
@section('functions')
    <script src="{{asset("/")}}js/regexPatterns.js"></script>
    <script src="{{asset("/")}}js/functions.js"></script>
@endsection

@section('scripts')
    <script src="{{asset("/")}}js/moderator/categories.js"></script>
@endsection

