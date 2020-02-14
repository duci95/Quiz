<?php $__env->startSection('content'); ?>
<div class="container-fluid background"></div>

<div class="container">
    <div class="d-flex flex-row align-items-center justify-content-around">
        <div class="card-header none title text-center fixed-top">
            <a href="#" class="text-white">ICT Expert QUIZ</a>
        </div>
        <div id="fade1" class="card">
            <div class="card-header bg-dark text-center">
                <span class="text-white h5 text-uppercase ">prijava</span>
            </div>
            <div class="card-body">
                <form class="form-group">
                    <label for="email" class="text-muted">Email</label>
                    <input type="text" class="form-control" id="email">
                    <p class="text-danger disabled small ">Neispravan format email-a</p>
                    <label for="password" class="text-muted">Lozinka</label>
                    <input type="text" class="form-control" id="password">
                    <a href="#" class="text-muted small">Zaboravljena lozinka?</a>
                    <input type="button" class="form-control btn btn-success text-uppercase mt-lg-3" value="prijavi se" id="btn">
                </form>
            </div>
            <div class="card-footer">
                <div class="d-inline-flex align-items-center justify-content-around">
                    <span class="text-muted">Nisi registrovan?</span>
                    <span class="p-sm-2 btn btn-info text-white text-center" id="reg-link">Registruj se!</span>
                </div>
            </div>
        </div>
        <div id="fade2" class="card d-none">
            <div class="card-header bg-dark text-center">
                <span class="text-white text-uppercase h5">registracija</span>
            </div>
            <div class="card-body">
                <form  class="form-group">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <label for="firstname" class="col-form-label">Ime</label>
                            <input type="text" class="form-control" id="firstname">
                        </div>
                        <div class="col-6">
                            <label for="lastname" class="col-form-label">Prezime</label>
                            <input type="text" class="form-control" id="lastname">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="text" class="form-control" id="email">
                        </div>
                        <div class="col-6">
                            <label for="img" class="col-form-label">Slika</label>
                            <input type="file" class="form-control-file" id="img" accept="image/jpeg image/gif">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="pass" class="col-form-label">Lozinka</label>
                            <input type="text" class="form-control" id="pass">
                        </div>
                        <div class="col-6">
                            <label for="passwordc" class="col-form-label">Ponovi lozinku</label>
                            <input type="text" class="form-control" id="passwordc">
                        </div>
                        
                            
                            
                        
                        <div class="col-12">
                            <input type="button" class="text-uppercase btn btn-success mt-3 form-control" value="Registruj se">
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-inline-flex align-items-center justify-content-around">
                    <span class="text-muted">Već imaš nalog?</span>
                    <span class="p-sm-2 btn btn-info text-white text-center" id="log-link" >Prijavi se!</span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset("/")); ?>js/login-reg.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Dusan\Quiz\resources\views/pages/log-reg.blade.php ENDPATH**/ ?>
