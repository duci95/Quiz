@extends('layouts.master')
@section('header')
@include('partials.header')
<div class="d-flex justify-content-center bg-info border-top border-light text-white p-1">{{$results[0]->first_name}} {{$results[0]->last_name}}</div>
@endsection
@section('content')
    <div class="content container mt-3">
        @foreach($results as $r)
            <div class="row justify-content-around align-content-center m-auto border-bottom border-top w-75 p-2">
                <span class="row col-2">
                    <span class="badge p-2 btn-primary w-100">{{$r->category_name}}</span>
                </span>
                <span class="row col-3 ">
                @if($r->trues >= $r->questions/2)
                        <span class="badge p-2 btn-success text-uppercase w-100">položen</span>
                    @else
                        <span class="badge p-2 btn-danger text-uppercase w-100">Nije položen</span>
                    @endif
                </span>
                <span class="row col-4 justify-content-center">
                    <span class="badge p-2 btn-info text-uppercase w-100">Broj pitanja : {{$r->questions}} </span>
                </span>
                <span class="row col-4">
                    <span class="badge p-2 btn-info text-uppercase w-100">Broj tačnih odgovora : {{$r->trues}}</span>
                </span>
            </div>
        @endforeach
        <span class="d-flex justify-content-center">
            {{$results->links()}}
        </span>
    </div>
@endsection
