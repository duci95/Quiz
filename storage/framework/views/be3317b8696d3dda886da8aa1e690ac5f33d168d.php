<div id="container">
<?php $__env->startSection('header'); ?>
    <?php if(!session()->has('user')): ?>
        <?php echo $__env->make('partials.header-null', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container mb-5 mt-3">
           <?php if(session()->has('user')): ?>
                <?php if(session()->get('user')->role_id === 2): ?>
                    <?php echo $__env->make('pages.moderator-categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php elseif(session()->get('user')->role_id === 1): ?>
                    <?php echo $__env->make('pages.administrator-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php elseif(session()->get('user')->role_id === 3): ?>
                    <?php echo $__env->make('pages.tester-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            <?php else: ?>
               <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row justify-content-sm-between m-auto p-2 border-top border-bottom mb-3 w-75">
                        <div class="row col-3 w-100">
                            <span class="p-2 btn-info quiz badge text-white w-100" onclick="goToLogin();"> <?php echo e($cat->category_name); ?></span>
                        </div>
                        <div class="col-8">
                            <span class="p-2 badge badge-info text-white w-100 text-left pl-5" ><?php echo e($cat->description); ?></span>
                        </div>
                    </div>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('functions'); ?>
    <script src="<?php echo e(asset("/")); ?>js/functions.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\New folder\Quiz\resources\views/pages/home.blade.php ENDPATH**/ ?>