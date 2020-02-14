<?php $__currentLoopData = $quiz; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $__env->startSection('header'); ?>
    <div class="w-100 bg-info text-white fixed-top">
            <div class="d-flex p-1 justify-content-around">
                <div class="d-flex justify-content-start">
                    <img src="<?php echo e(asset('/')); ?>images/<?php echo e(session()->get('user')->image_name); ?>"  alt="<?php echo e(substr(session()->get('user')->image_name,15,30)); ?>" title="<?php echo e(session()->get('user')->first_name); ?>">
                    <a title="Moj profil" href="#" class="navbar-brand text-white ml-3 mt-2"><?php echo e(session()->get('user')->first_name); ?> <?php echo e(session()->get('user')->last_name); ?></a>
                </div>
            <span  id="category" data-category="<?php echo e($data->category->id); ?>" class="h2 text-white mt-2 move-left align-content-center"><?php echo e($data->category->category_name); ?></span>
            <a href="<?php echo e(route('logout')); ?>" class="ml-5 btn btn-outline-dark h5 mt-2 text-center text-white">Odjavi se</a>
        </div>
        <p id="demo" class="text-white text-center h5 time bg-success m-0 p-1 margin-header-bottom">20:00</p>
    </div>
<?php $__env->stopSection(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container w-50 p-1 cards-margin mb-5">
        <?php $__currentLoopData = $quiz; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $questionNo => $questions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card m-3">
            <div class="card-header h5 p-1 text-center bg-info text-white">
                <span class="float-left  pl-4"><?php echo e($questionNo+1); ?>.</span>
                <input type="hidden" name="questions[]" value="<?php echo e($questions->id); ?>"/>
                <span  class="text-center"><?php echo e($questions->question); ?></span>
            </div>
            <div class="card-body p-0">
                   <?php $__currentLoopData = $questions->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answersNo => $answers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <div class="pl-3 radio">
                                   <input type="radio"  name="<?php echo e($questions->question); ?>[]" class="mt-2 " id="<?php echo e($answers->id); ?>" value="<?php echo e($answers->id); ?>"/>
                                   <label for="<?php echo e($answers->id); ?>"><?php echo e($answers->answer); ?> </label>
                               </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <button id="validate" class="justify-content-center btn btn-success d-flex m-auto text-uppercase">Predaj test</button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('functions'); ?>
    <script src="<?php echo e(asset("/")); ?>js/functions.js"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        stopWatch();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Desktop\Quiz\resources\views/pages/quiz.blade.php ENDPATH**/ ?>