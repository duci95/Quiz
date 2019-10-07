<div id="fade1" class="card">
    @if(session()->has('activated'))
        <div class="alert alert-success alert-dismissible mb-sm-auto fade show text-center" role="alert" >
            <span >Profil uspešno aktiviran! <button type="button" class="close " data-dismiss="alert" aria-label="Close">&times;</button></span>
        </div>
    @endif
    <div>
        <span class="animate-div progress-bar progress-bar-striped progress-bar-animated"></span>
    </div>

    <div class="errors bg-danger text-white text-center">

    </div>

    <div class="card-header bg-dark text-center">
        <span class="text-white h5 text-uppercase ">prijava</span>
        <noscript class="bg-danger p-3 text-white h6 text-center">Moraš uključiti JavaScript kako bi mogao da se prijaviš!</noscript>
    </div>

    <div class="card-body">
        <form class="form-group">
            <label for="emailLog" class="text-muted">Email</label>
            <input type="text" class="form-control" id="emailLog">
            <label for="password" class="text-muted">Lozinka</label>
            <input type="password" class="form-control" id="password">
            <a href="#" onclick="passwordRecoveryForm()" class="text-muted small">Zaboravljena lozinka?</a>
            <input type="button"  class="form-control btn btn-info text-uppercase mt-lg-3" value="prijavi se" id="logBtn">
        </form>
    </div>
    <div class="card-footer">
        <div class="d-inline-flex align-items-center justify-content-around">
            <span class="text-muted">Nisi registrovan?</span>
            <span class="p-sm-2 btn btn-outline-info text-center" onclick="registrationForm();">Registruj se!</span>
        </div>
    </div>
</div>
