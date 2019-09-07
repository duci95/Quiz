@extends('layouts.master')
@section('content')

<div class="container-fluid background">
</div>
<div class="container">
    <div class="d-flex flex-row align-items-center justify-content-around">
        <div class="card-header h4 text-center fixed-top">
            <a href="#" class="text-white">ICT Expert QUIZ</a>
        </div>

        <div id="fade1" class="card">
            <noscript class="bg-danger p-3 text-white h6 text-center">Moraš uključiti JavaScript kako bi mogao da se prijaviš!</noscript>
            <div class="card-header bg-dark text-center">
                <span class="text-white h5 text-uppercase ">prijava</span>
            </div>
            <div class="card-body">
                <form class="form-group">
                    <label for="emailLog" class="text-muted">Email</label>
                    <input type="text" class="form-control" id="emailLog">
                    <label for="password" class="text-muted">Lozinka</label>
                    <input type="text" class="form-control" id="password">
                    <a href="#" class="text-muted small">Zaboravljena lozinka?</a>
                    <input type="button" class="form-control btn btn-info text-uppercase mt-lg-3" value="prijavi se" id="btn">
                </form>
            </div>
            <div class="card-footer">
                <div class="d-inline-flex align-items-center justify-content-around">
                    <span class="text-muted">Nisi registrovan?</span>
                    <span class="p-sm-2 btn btn-outline-info text-center" id="reg-link">Registruj se!</span>
                </div>
            </div>
        </div>
        <div id="fade2" class="card d-none">
            <div class="title">
                <span id="animate-div" class="progress-bar progress-bar-striped progress-bar-animated"></span>
            </div>
            <div class="card-header bg-dark text-center">
                <span class="text-white text-uppercase h5">registracija</span>
                <noscript class="alert-danger h6">Moraš uključiti JavaScript kako bi mogao da se registruješ!</noscript>
            </div>
            <div class="card-body">
                <form  class="form-group">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <label for="firstname" class="col-form-label text-muted">Ime</label>
                            <input type="text" class="form-control" id="firstname">
                        </div>
                        <div class="col-6">
                            <label for="lastname" class="col-form-label text-muted">Prezime</label>
                            <input type="text" class="form-control" id="lastname">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="email" class="col-form-label text-muted text-muted">Email</label>
                            <input type="text" class="form-control" id="email">
                        </div>
                        <div class="col-6">
                            <label for="img" class="col-form-label text-muted">Slika</label>
                            <input type="file" class="form-control-file" id="img" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="pass" class="col-form-label text-muted">Lozinka</label>
                            <input type="text" class="form-control" id="pass">
                        </div>
                        <div class="col-6">
                            <label for="passwordc" class="col-form-label text-muted">Ponovi lozinku</label>
                            <input type="text" class="form-control" id="passwordc">
                        </div>
                        {{--<div class="col-12">--}}
                            {{--<input type="checkbox" class="small" id="agree">--}}
                            {{--<label for="agree" class="col-form-label text-muted" >Potvrđujem da sam upoznat sa pravima korišćenja</label>--}}
                        {{--</div>--}}
                        <div class="col-12">
                            <input type="button" id="regBtn" class="text-uppercase btn btn-info mt-3 form-control" value="Registruj se">
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-inline-flex align-items-center justify-content-around">
                    <span class="text-muted">Već imaš nalog?</span>
                    <span class="p-sm-2 btn btn-outline-info text-center" id="log-link" >Prijavi se!</span>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{asset("/")}}js/login-reg.js"></script>
@endsection
