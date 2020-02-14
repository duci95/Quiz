<?php echo $__env->make('partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('header'); ?>
<?php echo $__env->yieldContent('content'); ?>
<script src="<?php echo e(asset("/")); ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo e(asset("/")); ?>plugins/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo e(asset("/")); ?>plugins/notify.min.js"></script>
<script src="<?php echo e(asset("/")); ?>plugins/bootbox.all.min.js"></script>

<?php echo $__env->yieldContent('functions'); ?>
<?php echo $__env->yieldContent('scripts'); ?>
<?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="<?php echo e(asset("/")); ?>js/user.js"></script><?php /**PATH D:\Desktop\Quiz\resources\views/layouts/master.blade.php ENDPATH**/ ?>