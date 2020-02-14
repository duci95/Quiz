<?php $__env->startSection('header'); ?>
<?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="d-flex justify-content-center bg-info border-top border-light text-white p-1"><?php echo e($results[0]->first_name); ?> <?php echo e($results[0]->last_name); ?></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content container mt-3">
        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row justify-content-around align-content-center m-auto border-bottom border-top w-75 p-2">
                <span class="row col-2">
                    <span class="badge p-2 btn-primary w-100"><?php echo e($r->category_name); ?></span>
                </span>
                <span class="row col-3 ">
                <?php if($r->trues >= $r->questions/2): ?>
                        <span class="badge p-2 btn-success text-uppercase w-100">položen</span>
                    <?php else: ?>
                        <span class="badge p-2 btn-danger text-uppercase w-100">Nije položen</span>
                    <?php endif; ?>
                </span>
                <span class="row col-4 justify-content-center">
                    <span class="badge p-2 btn-info text-uppercase w-100">Broj pitanja : <?php echo e($r->questions); ?> </span>
                </span>
                <span class="row col-4">
                    <span class="badge p-2 btn-info text-uppercase w-100">Broj tačnih odgovora : <?php echo e($r->trues); ?></span>
                </span>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <span class="d-flex justify-content-center">
            <?php echo e($results->links()); ?>

        </span>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Dusan\Quiz\resources\views/pages/moderator-statistics-user-one.blade.php ENDPATH**/ ?>