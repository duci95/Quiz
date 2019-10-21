@extends('layouts.master')
@section('header')
    @include('partials.header')
@endsection
<div class="d-flex justify-content-center bg-info text-white p-1">Spisak korisnika</div>
@section('content')
    <div class="row justify-content-between border-bottom border-top p-1 m-2">
        <div class="row justify-content-start col-1"></div>
    </div>
    <div class="content container">
    @foreach($categories as $r)
           <div class="row justify-content-between border-bottom border-top p-1 m-2">
                <div class="row col-xl-1">
                        <img src="{{asset('/images/')}}/{{$r->picture->image_name}}" alt="{{substr($r->picture->image_name,0,10)}}" title="{{substr($r->picture->image_name,0,10)}}">
                </div>
            <div class="row col-6 justify-content-start  align-content-center">
               <span class="badge p-2 btn-primary mr-3">{{$r->first_name}} {{$r->last_name}}</span>
                <span class="badge p-2 btn-primary">{{$r->email}}</span>
            </div>
            <div class="row justify-content-end col-4  align-content-center">
                @if($r->is_blocked === 1)
                <span class="badge p-2 btn-warning text-white text-uppercase mr-3"> Blokiran</span>
                @else
                @endif
                @if($r->active === 1)
                <span class="badge p-2 btn-success text-uppercase mr-3">Aktivan</span>
                @endif
                <span data-id="{{$r->id}}" class="badge p-2 btn-primary btn edit text-uppercase mr-3 btn btn-primary" data-toggle="modal" data-target="#{{$r->id}}">Izmeni</span>
                <span href="{{route('statistics-user',['id' => $r->user_id])}}" class=" text-uppercase text-white badge btn p-2 btn-danger">Obriši</span>
                @include('modals.admin-edit-user-modal')
            </div>
                </div>
    @endforeach
    </div>
@endsection
@section('scripts')
    <script src="{{asset("/")}}js/admin/admin-edit-user.js"></script>
@endsection
