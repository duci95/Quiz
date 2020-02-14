<a class="btn row justify-content-start btn-info badge text-white mb-2" href="<?php echo e(route('users.show',['user'=> session()->get('user')->id])); ?>">Moji rezultati</a>
<div class="row  mb-3 border-top border-bottom p-0 w-75 m-auto">
<div class="row col-3 justify-content-center p-0">
    <span class="badge">Kategorija testa</span>
</div>
<div class="col-6 row justify-content-end align-content-center p-0">
    <span class="badge">Opis testa</span>
</div>
</div>
<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="row justify-content-sm-between m-auto p-2 border-top border-bottom mb-3 w-75">
    <?php if(session()->has('blocked')): ?>
        <div class="row col-3 w-100">
            <span class="p-2 btn-secondary restrict badge text-white w-100" data-category-name="<?php echo e($cat->category_name); ?>" data-category="<?php echo e($cat->id); ?>" data-user="<?php echo e(session()->get('user')->id); ?>" ><?php echo e($cat->category_name); ?></span>
        </div>
    <?php else: ?>
        <div class="row col-3 w-100">
            <span class="p-2 btn-info quiz badge text-white w-100" data-category-name="<?php echo e($cat->category_name); ?>" data-category="<?php echo e($cat->id); ?>" data-user="<?php echo e(session()->get('user')->id); ?>" ><?php echo e($cat->category_name); ?></span>
        </div>
    <?php endif; ?>
    <div class="col-8">
        <span class="p-2 badge badge-info text-white w-100 text-left pl-5" ><?php echo e($cat->description); ?></span>
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
    <?php if(session()->has('blocked')): ?>
        <script type="text/javascript">
            bootbox.alert({
                message: "Nalog blokiran",
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
<?php /**PATH D:\Desktop\Quiz\resources\views/pages/tester-content.blade.php ENDPATH**/ ?>