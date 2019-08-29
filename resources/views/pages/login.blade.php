@extends('layouts.master')
@section('content')
    <div class="container-fluid background"></div>
    <div class="container">
        <div class="d-flex flex-row align-items-center justify-content-between">

            <div class="card">
                <div class="card-header text-center">
                    ICT Expert Quiz
                </div>
                <div class="card-body ">
                    <p class="text-center">Proverite svoje znanje iz sledecih oblasti</p>
                </div>
                <div class="card-footer">
                    <p class="text-primary text-center">WEB DIZAJN</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-dark text-center">
                    <span class="text-white big text-uppercase ">Prijavi se</span>
                </div>
                <div class="card-body">
                    <form action="" class="form-group">
                        <label for="email" class="text-muted">Email</label>
                        <input type="text" class="form-control" id="email">
                        <label for="password" class="text-muted">Lozinka</label>
                        <input type="text" class="form-control" id="password">

                        <input type="button" class="form-control btn-success button text-uppercase mt-lg-3" value="ok" id="btn">
                    </form>

                </div>
                <div class="card-footer">
                    <div class="d-inline-flex flex-row align-items-center justify-content-around">
                        <span class="text-muted ">Niste registrovani?</span>
                        <a href="#" class="text-center text-white bg-info p-sm-2 list-unstyled" >Registruj se!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
