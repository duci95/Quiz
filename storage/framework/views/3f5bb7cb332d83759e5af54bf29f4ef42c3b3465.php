<div class="container-fluid bg-info">
    <div class="row justify-content-around align-items-center w-100 p-0">
        <span class="row justify-content-start align-content-center">
            <a title="Izmeni profil" data-toggle="modal" data-target="#modalEdit" class="p-1 text-white ml-3"><img src="<?php echo e(asset('/')); ?>images/<?php echo e(session()->get('user')->image_name); ?>"  alt="<?php echo e(substr(session()->get('user')->image_name,15,30)); ?>" title="<?php echo e(session()->get('user')->first_name); ?>">
         <?php echo e(session()->get('user')->first_name); ?> <?php echo e(session()->get('user')->last_name); ?></a>
        </span>
        <?php echo $__env->make('modals.user-edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php if(session()->get('user')->role_id === 1): ?>
            <a href="<?php echo e(route('admins.index')); ?>" class="row justify-content-center align-items-center navbar-brand text-white">ICT Expert QUIZ</a>
        <?php elseif(session()->get('user')->role_id === 2): ?>
            <a href="<?php echo e(route('categories.index')); ?>" class=" row justify-content-center align-items-center navbar-brand text-white">ICT Expert QUIZ</a>
        <?php else: ?>
            <a href="<?php echo e(route('index')); ?>" class="row justify-content-center align-items-center navbar-brand text-white">ICT Expert QUIZ</a>
        <?php endif; ?>
        <span class="row justify-content-end align-content-center">
            <a href="<?php echo e(route('logout')); ?>" class="btn p-2 bg-light text-info">Odjavi se</a>
        </span>
    </div>
</div>
<?php /**PATH D:\Desktop\Quiz\resources\views/partials/header.blade.php ENDPATH**/ ?>