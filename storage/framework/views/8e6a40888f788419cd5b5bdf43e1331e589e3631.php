<?php $__env->startSection('content'); ?>
<div class="container-fluid background"></div>
<div class="container">
    <div class="d-flex center flex-row align-items-center justify-content-around">

        <?php echo $__env->make('partials.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('partials.registration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('partials.passwordRecovery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php $__env->startSection('functions'); ?>
            <script src="<?php echo e(asset("/")); ?>js/regexPatterns.js"></script>
            <script src="<?php echo e(asset("/")); ?>js/functions.js"></script>
        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('scripts'); ?>
            <script src="<?php echo e(asset("/")); ?>js/login.js"></script>
            <script src="<?php echo e(asset("/")); ?>js/registration.js"></script>
            <script src="<?php echo e(asset("/")); ?>js/passwordRecovery.js"></script>
        <?php $__env->stopSection(); ?>

        <?php if(request()->getQueryString() !== null): ?>
            <script>
                document.getElementById("fade1").style.display = 'none';
                document.getElementById("fade2").setAttribute('class',"d-block");
                document.getElementById("fade2").setAttribute('class',"card");
            </script>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Dusan\Quiz\resources\views/pages/log-reg.blade.php ENDPATH**/ ?>