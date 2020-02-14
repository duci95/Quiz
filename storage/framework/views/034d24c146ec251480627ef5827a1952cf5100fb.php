<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="d-flex justify-content-center border-top border-light  bg-info text-white p-1"><?php echo e($users[0]->category_name); ?></div>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content container">
<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="row border-bottom justify-content-center border-top  m-2">
        <span class="row justify-content-start col-2">
            <img src="<?php echo e(asset('/images/')); ?>/<?php echo e($u->image_name); ?>" alt="<?php echo e(substr($u->image_name,0,10)); ?>" title="<?php echo e(substr($u->image_name,0,10)); ?>">
        </span>
        <span class="row justify-content-start col-5 align-content-center">
            <a href="<?php echo e(route('statistics-user',['id' => $u->user_id])); ?>" class="badge text-white p-2 btn btn-info mr-3"><?php echo e($u->first_name); ?> <?php echo e($u->last_name); ?></a>
            <span class="badge p-2 btn-primary"><?php echo e($u->email); ?></span>
        </span>
        <span class="row justify-content-end col-5 align-content-center">
            <?php if($u->trues >= $questions[0]->questions/2): ?>
            <span class=" badge p-2 btn-success text-uppercase">položen</span>
            <?php else: ?>
            <span class=" badge p-2 btn-danger text-uppercase">Nije položen</span>
            <?php endif; ?>
        </span>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <span class="d-flex justify-content-center">
            <?php echo e($users->links()); ?>

        </span>
</div>
<?php $__env->stopSection(); ?>










<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Desktop\Quiz\resources\views/pages/moderator-statistics-category.blade.php ENDPATH**/ ?>