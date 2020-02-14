<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="d-flex justify-content-center bg-info border-top border-light text-white p-1">Spisak korisnika i rezultata za sve kategorije</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content container m-auto ">
        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row justify-content-center border-bottom border-top p-1 m-2">
                <span class="row justify-content-start col-2">
                    <img src="<?php echo e(asset('/images/')); ?>/<?php echo e($r->image_name); ?>" alt="<?php echo e(substr($r->image_name,0,10)); ?>" title="<?php echo e(substr($r->image_name,0,10)); ?>">
                </span>
                <span class="row justify-content-start col-5  align-content-center">
                    <span class="badge p-2 btn-primary mr-3"><?php echo e($r->first_name); ?> <?php echo e($r->last_name); ?></span>
                <span class="badge p-2 btn-primary"><?php echo e($r->email); ?></span>
                </span>
                <span class="row justify-content-end col-5  align-content-center">
                    <a href="<?php echo e(route('statistics-user',['id' => $r->user_id])); ?>"  class="text-uppercase text-white badge btn p-2 btn-info">Vidi rezultate</a>
                </span>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <span class="d-flex justify-content-center">
            <?php echo e($results->links()); ?>

        </span>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Desktop\Quiz\resources\views/pages/moderator-statistics-users.blade.php ENDPATH**/ ?>