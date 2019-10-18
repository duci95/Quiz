@extends('layouts.master')
@section('header')
    @include('partials.header')
@endsection
<div class="d-flex justify-content-center bg-info text-white p-1">Spisak korisnika</div>
@section('content')
    @foreach($categories as $r)
        <div class="content container">
                <div class="row justify-content-center border-bottom border-top p-1 m-2">
                <span class="row justify-content-start col-2">
                    @foreach($r->pictures as $p)
                        <img src="{{asset('/images/')}}/{{$p->image_name}}" alt="{{substr($r->image_name,0,10)}}" title="{{substr($r->image_name,0,10)}}">
                    @endforeach
                </span>
            <span class="row justify-content-start col-5  align-content-center">
            <span class="badge p-2 btn-primary mr-3">{{$r->first_name}} {{$r->last_name}}</span>
            <span class="badge p-2 btn-primary">{{$r->email}}</span>
        </span>
            <span class="row justify-content-end col-5  align-content-center">
                @if($r->is_blocked === 1)
                <span class="badge p-2 btn-warning text-white text-uppercase mr-3"> Blokiran</span>
                @else
                @endif
                @if($r->active === 1)
                <span class="badge p-2 btn-success text-uppercase mr-3">Aktivan</span>
                @endif
                <span class="badge p-2 btn-primary btn text-uppercase mr-3">Izmeni</span>
                <span href="{{route('statistics-user',['id' => $r->user_id])}}"  class=" text-uppercase text-white badge btn p-2 btn-danger">Obriši</span>
            </span>
                </div>
            <span class="d-flex justify-content-center">
        </span>
        </div>
    @endforeach
@endsection
