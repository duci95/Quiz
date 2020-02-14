<div class="row m-2 d-flex justify-content-between">
    <span class="btn btn-success badge p-2 insert text-center">Dodaj kategoriju</span>
    <a href="<?php echo e(route('statistics-all-users')); ?>" class="btn btn-warning badge p-2  text-center">Prikaz rezultata po korisniku</a>
</div>
<div class="content">
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row justify-content-between m-auto border-bottom border-top p-2 m-2 w-75">
        <span class="col-2 w-100 row">
            <a href="<?php echo e(route('one',['id' => $cat->id])); ?>" class=" w-100 text-white btn badge p-2 mr-3 btn-info"><?php echo e($cat->category_name); ?></a>
        </span>
            <span class="col-2 row">
                <a href="<?php echo e(route('statistics.show',['statistic' => $cat->id])); ?>" class="  text-white badge btn p-2 btn-info ">Rezultati</a>
            </span>
        <span class="col-5 row justify-content-start align-content-center">
            <span class="text-info badge"><?php echo e($cat->description); ?></span>
        </span>
            <span class="col-3 row justify-content-end">
                <span data-category="<?php echo e($cat->id); ?>" class="mr-2 edit-category btn btn-primary badge p-2">Izmeni</span>
                <span data-category="<?php echo e($cat->id); ?>" class="delete-category btn btn-danger badge p-2">Obriši</span>
            </span>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->startSection('functions'); ?>
    <script src="<?php echo e(asset("/")); ?>js/regexPatterns.js"></script>
    <script src="<?php echo e(asset("/")); ?>js/functions.js"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset("/")); ?>js/moderator/categories.js"></script>
    <?php if(session()->has('empty')): ?>
        <script>
            bootbox.alert('Nema rezultata za ovu kategoriju!')
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php /**PATH D:\Dusan\Quiz\resources\views/pages/moderator-categories.blade.php ENDPATH**/ ?>