@extends('layouts.master')
@section('header')
    @include('partials.header')
@endsection
@section('content')
    <div class="container m-2 w-75 m-auto p-2">
            <span class="btn btn-info insert badge" data-toggle="modal" data-target="#insert">Dodaj korisnika</span>
    </div>
    @include('modals.admin-insert-user-modal')
    <div class="content container">
    @foreach($categories as $r)
           <div class="row justify-content-between border-bottom border-top p-1 w-75 m-auto">
                <div class="row col-xl-1 ">
                        <img src="{{asset('/images/')}}/{{$r->picture->image_name}}" alt="{{substr($r->picture->image_name,0,10)}}" title="{{substr($r->picture->image_name,0,10)}}" >
                </div>
                <div class="row col-6 justify-content-start  align-content-center">
                    <span class="badge p-2 btn-primary mr-3">{{$r->first_name}} {{$r->last_name}}</span>
                    <span class="badge p-2 btn-primary">{{$r->email}}</span>
                </div>
                <div class="row justify-content-end col-4 align-content-center">
                    @if($r->is_blocked === 1)
                        <span class="badge p-2 btn-warning text-white text-uppercase mr-3">Blokiran</span>
                    @endif
                    @if($r->active === 0)
                        <span class="badge p-2 btn-secondary text-uppercase mr-3">Neaktivan</span>
                    @endif
                    <span data-id="{{$r->id}}" class="badge p-2 btn-primary btn edit text-uppercase mr-3 btn btn-primary" data-toggle="modal" data-target="#{{$r->id}}">Izmeni</span>
                    <span data-id="{{$r->id}}" class="text-uppercase text-white badge btn p-2 btn-danger delete">Obriši</span>
                </div>
           </div>
           @include('modals.admin-edit-user-modal')
    @endforeach
    </div>
@endsection
@section('scripts')
    <script src="{{asset("/")}}js/admin/users.js"></script>
@endsection
