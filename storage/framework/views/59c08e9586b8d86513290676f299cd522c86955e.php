<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="row justify-content-around radius p-2 border mb-3">
    <div class="col-sm-3 text-center">
        <?php if(session()->has('user')): ?>
            <p class="h3 mt-2 p-2 radius btn-info quiz text-white"  data-category-name="<?php echo e($cat->category_name); ?>" data-category="<?php echo e($cat->id); ?>" data-user="<?php echo e(session()->get('user')->id); ?>" ><?php echo e($cat->category_name); ?></p>
        <?php else: ?>
            <p class="h3 mt-2 p-2 radius btn-info quiz text-white" onclick="goToLogin();"> <?php echo e($cat->category_name); ?></p>
        <?php endif; ?>
    </div>
    <div class="col-5 text-center radius bg-info text-white desc">
        <span ><?php echo e($cat->description); ?></span>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset("/")); ?>js/quizRouting.js"></script>
    <?php if(session()->has('error')): ?>
        <script type="text/javascript">
            bootbox.alert({
                message: "Test je još uvek u pripremi!",
                small: 'small',
                buttons : {
                    ok: {
                        label : 'U redu',
                        className : 'btn-info'
                    }
                }
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php /**PATH D:\Dusan\Quiz\resources\views/partials/tester-content.blade.php ENDPATH**/ ?>