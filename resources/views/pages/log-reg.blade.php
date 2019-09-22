@extends('layouts.master')
@section('content')
<div class="container-fluid background"></div>
<div class="container">
    <div class="d-flex flex-row align-items-center justify-content-lg-center">
        <div class="card-header h4 text-center fixed-top">
            <a href="#" class="text-white">ICT Expert QUIZ</a>
        </div>

        @include('partials.login')
        @include('partials.registration')
        @include('partials.passwordRecovery')

        @section('functions')
            <script src="{{asset("/")}}js/regexPatterns.js"></script>
            <script src="{{asset("/")}}js/functions.js"></script>
        @endsection
        @section('scripts')
            <script src="{{asset("/")}}js/login.js"></script>
            <script src="{{asset("/")}}js/registration.js"></script>
            <script src="{{asset("/")}}js/passwordRecovery.js"></script>
        @endsection
    </div>
</div>
@endsection
