@extends('layouts.master')
@section('header')
    @include('partials.header')
@endsection
@section('content')
    <div class="content container">
        @foreach($results as $r)
            <div class="row  border-bottom border-top p-2 m-2">
        <span class="row justify-content-between col-10 m-auto">
            <span class="badge p-2 btn-primary mr-3">{{$r->category_name}}</span>
            @if($r->trues >= $r->questions/2)
                <span class=" badge p-2 btn-success text-uppercase">položen</span>
            @else
                <span class=" badge p-2 btn-danger text-uppercase">Nije položen</span>
            @endif
            <span class=" badge p-2 btn-info mr-4 text-uppercase">Broj pitanja : {{$r->questions}} </span>
            <span class=" badge p-2 btn-info text-uppercase">Broj tačnih odgovora : {{$r->trues}}</span>
        </span>
            </div>
        @endforeach
        <span class="d-flex justify-content-center">
            {{$results->links()}}
        </span>
    </div>
@endsection