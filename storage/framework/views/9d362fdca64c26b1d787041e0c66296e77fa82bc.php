<div id="fade2" class="card d-none">
    <div>
        <span class="animate-div progress-bar progress-bar-striped progress-bar-animated"></span>
    </div>
    <div class="bg-success text-center text-white" id="reg-success"></div>

    <div class="bg-danger errors text-center text-white"></div>

    <div class="card-header bg-dark text-center">
        <span class="text-white text-uppercase h5">registracija</span>
        <noscript class="alert-danger h6">Moraš uključiti JavaScript kako bi mogao da se registruješ!</noscript>
    </div>

    <div class="card-body">
        <form  class="form-group" enctype="multipart/form-data">
            <div class="row justify-content-center">
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
                    <input type="file" accept="image/gif,image/jpeg,image/png"  class="form-control-file" id="img" >
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="pass" class="col-form-label text-muted">Lozinka</label>
                    <input type="password" class="form-control" id="pass">
                </div>
                <div class="col-6">
                    <label for="passwordc" class="col-form-label text-muted">Ponovi lozinku</label>
                    <input type="password" class="form-control" id="passwordc">
                </div>

                <div class="col-12">
                    <input type="button" id="regBtn" class="text-uppercase btn btn-info mt-3 form-control" value="Registruj se">
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <div class="d-inline-flex align-items-center justify-content-around">
            <span class="text-muted">Već imaš nalog?</span>
            <span class="p-sm-2 btn btn-outline-info text-center" onclick="loginForm();">Prijavi se!</span>
        </div>
    </div>
</div>
<?php /**PATH D:\New folder\Quiz\resources\views/partials/registration.blade.php ENDPATH**/ ?>