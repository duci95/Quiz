@extends('layouts.master')
@section('header')
    @include('partials.header')
    <div class="d-flex justify-content-center bg-info text-white p-1">Spisak korisnika i njihovih rezultata</div>
@endsection
@section('content')
<div class="content container">
@foreach($users as $u)
    <div class="d-flex border-bottom border-top p-2 m-2 ">
        <span class="d-flex justify-content-start w-100">
            <span class="badge p-2 btn-info mr-3">{{$u->first_name}} {{$u->last_name}}</span>
            <span class="badge p-2 btn-primary">{{$u->email}}</span>
        </span>
        <span class="d-flex justify-content-end">
            @if($u->trues > $u->questions/2)
            <span class=" badge p-2 btn-success text-uppercase">položio</span>
            @else
            <span class=" badge p-2 btn-danger text-uppercase">Nije položio</span>
            @endif
        </span>

    </div>

@endforeach
</div>
@endsection
@section('functions')
    <script src="{{asset("/")}}js/regexPatterns.js"></script>
    <script src="{{asset("/")}}js/functions.js"></script>
@endsection

@section('scripts')
    <script src="{{asset("/")}}js/moderator/categories.js"></script>
@endsection
