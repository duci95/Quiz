<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container m-2 w-75 m-auto p-2">
            <span class="btn btn-info insert badge" data-toggle="modal" data-target="#insert">Dodaj korisnika</span>
    </div>
    <?php echo $__env->make('modals.admin-insert-user-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content container">
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <div class="row justify-content-between border-bottom border-top p-1 w-75 m-auto">
                <div class="row col-xl-1 ">
                        <img src="<?php echo e(asset('/images/')); ?>/<?php echo e($r->picture->image_name); ?>" alt="<?php echo e(substr($r->picture->image_name,0,10)); ?>" title="<?php echo e(substr($r->picture->image_name,0,10)); ?>" >
                </div>
                <div class="row col-6 justify-content-start  align-content-center">
                    <span class="badge p-2 btn-primary mr-3"><?php echo e($r->first_name); ?> <?php echo e($r->last_name); ?></span>
                    <span class="badge p-2 btn-primary"><?php echo e($r->email); ?></span>
                </div>
                <div class="row justify-content-end col-4 align-content-center">
                    <?php if($r->is_blocked === 1): ?>
                        <span class="badge p-2 btn-warning text-white text-uppercase mr-3">B</span>
                    <?php endif; ?>
                    <?php if($r->active === 0): ?>
                        <span class="badge p-2 btn-secondary text-uppercase mr-3">N</span>
                    <?php endif; ?>
                    <span data-id="<?php echo e($r->id); ?>" class="badge p-2 btn-primary btn edit text-uppercase mr-3 btn btn-primary" data-toggle="modal" data-target="#<?php echo e($r->id); ?>">Izmeni</span>
                    <span data-id="<?php echo e($r->id); ?>" class="text-uppercase text-white badge btn p-2 btn-danger delete">Obriši</span>
                </div>
           </div>
           <?php echo $__env->make('modals.admin-edit-user-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset("/")); ?>js/admin/users.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Desktop\Quiz\resources\views/pages/administrator-content.blade.php ENDPATH**/ ?>