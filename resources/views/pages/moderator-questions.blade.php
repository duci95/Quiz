@extends('layouts.master')
@section('header')
        @include('partials.header')
@endsection
@section('content')
<div class="container content">
    <div class="row m-2 d-flex justify-content-between">
        <span class="btn btn-success insert align-content-center text-center">Dodaj pitanje</span>
    </div>
    @foreach($questions as $question)
        <div class="row justify-content-around border-bottom border-top p-2  m-2">
        <span class="col-4">
            <a href="{{route('answers.index',['id' => $question->id])}}" class="text-white btn btn-info">{{$question->question}} ?</a>
        </span>
            <span data-category="{{$question->id}}" class="edit btn btn-primary">Izmeni</span>
            <span data-category="{{$question->id}}" class="delete btn btn-danger d-flex justify-content-end ">Obriši</span>
        </div>
    @endforeach
</div>
@endsection
