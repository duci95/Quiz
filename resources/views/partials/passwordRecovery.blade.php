<div id="fade3" class="card d-none">
    <div>
        <span class="animate-div progress-bar progress-bar-striped progress-bar-animated"></span>
    </div>
    <div  class="errors bg-danger text-white text-center">

    </div>
    <div class="card-header bg-dark text-center">
        <span class="text-white h5 text-uppercase ">Oporavak lozinke</span>
        <noscript class="bg-danger p-3 text-white h6 text-center">Moraš uključiti JavaScript kako bi mogao da se prijaviš!</noscript>
    </div>
    <div class="card-body">
        <form class="form-group">
            <label for="emailRecovery" class="text-muted">Email</label>
            <input type="text" class="form-control" id="emailRecovery">
            <input type="button"  class="form-control btn btn-info text-uppercase mt-lg-3" value="Pošalji" id="recoveryBtn">
        </form>
    </div>
    <div class="card-footer">
        <div class="d-inline-flex align-items-center justify-content-around">
            <span class="text-muted">Nisi registrovan?</span>
            <span class="p-sm-2 btn btn-outline-info text-center" onclick="registrationFormFromPasswordRecoveryForm()">Registruj se!</span>
        </div>
        <div class="p-sm-1 bord"></div>
        <div class="d-inline-flex align-items-center justify-content-around">
            <span class="text-muted">Setio si se lozinke?</span>
            <span class="p-sm-2 btn btn-outline-info text-center" onclick="loginFormFromPasswordRecoveryForm()">Prijavi se!</span>
        </div>
    </div>
</div>
