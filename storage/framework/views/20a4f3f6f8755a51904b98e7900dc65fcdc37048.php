<div class="content">
    <div class="row m-2 d-flex justify-content-between">
        <span class="btn btn-success insert align-content-center text-center">Dodaj kategoriju</span>
    </div>
<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row justify-content-around border-bottom border-top p-2  m-2">
        <span class="col-2">
            <a href="<?php echo e(route('questions.index',['id' => $cat->id])); ?>" class="text-white btn btn-info"><?php echo e($cat->category_name); ?></a>
        </span>
            <span class="col-6">
            <span class="text-info"><?php echo e($cat->description); ?></span>
        </span>
            <span data-category="<?php echo e($cat->id); ?>" class="edit btn btn-primary">Izmeni</span>
            <span data-category="<?php echo e($cat->id); ?>" class="delete btn btn-danger d-flex justify-content-end ">Obriši</span>
        </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->startSection('functions'); ?>
    <script src="<?php echo e(asset("/")); ?>js/regexPatterns.js"></script>
    <script src="<?php echo e(asset("/")); ?>js/functions.js"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset("/")); ?>js/moderator/categories.js"></script>
<?php $__env->stopSection(); ?>
<?php /**PATH D:\Dusan\Quiz\resources\views/partials/moderator-categories.blade.php ENDPATH**/ ?>
