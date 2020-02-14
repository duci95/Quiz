@extends('layouts.master')
@section('content')
<div class="container-fluid background"></div>
<div class="container">
    <div class="d-flex center flex-row align-items-center justify-content-around">

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

        @if(request()->getQueryString() !== null)
            <script>
                document.getElementById("fade1").style.display = 'none';
                document.getElementById("fade2").setAttribute('class',"d-block");
                document.getElementById("fade2").setAttribute('class',"card");
            </script>
        @endif
    </div>
</div>
@endsection
