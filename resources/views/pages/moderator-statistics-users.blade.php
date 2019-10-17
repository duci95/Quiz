@extends('layouts.master')
@section('header')
    @include('partials.header')
    <div class="d-flex justify-content-center bg-info text-white p-1">Spisak korisnika i rezultata za sve kategorije</div>
@endsection
@section('content')
    <div class="content container">
        @foreach($results as $r)
            <div class="row justify-content-center border-bottom border-top p-1 m-2">
                <span class="row justify-content-start col-2 ">
            <img src="{{asset('/images/')}}/{{$r->image_name}}" alt="{{substr($r->image_name,0,10)}}" title="{{substr($r->image_name,0,10)}}">
        </span>
        <span class="row justify-content-start col-5  align-content-center">
            <span class="badge p-2 btn-primary mr-3">{{$r->first_name}} {{$r->last_name}}</span>
            <span class="badge p-2 btn-primary">{{$r->email}}</span>
        </span>
        <span class="row justify-content-end col-5  align-content-center">
            <span class="badge p-2 btn-primary text-uppercase mr-3">Broj testova : {{$r->tests}}</span>
            <a href="{{route('statistics-user',['id' => $r->user_id])}}"  class=" text-uppercase text-white badge btn p-2 btn-info">Vidi rezultate</a>
        </span>
            </div>
        @endforeach
            <span class="d-flex justify-content-center">
            {{$results->links()}}
        </span>
    </div>
@endsection
@section('functions')
    <script src="{{asset("/")}}js/regexPatterns.js"></script>
    <script src="{{asset("/")}}js/functions.js"></script>
@endsection
@section('scripts')

@endsection
