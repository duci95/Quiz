<?php $__env->startSection('header'); ?>
        <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-2">
    <a href="<?php echo e(route('categories.index')); ?>" class="row mr-5 ml-3 p-1 btn-warning badge text-dark text-center"> <i class="fa fa-arrow-left "> </i>  Kategorije </a>
    <span data-category="<?php echo e($category); ?>" class="btn btn-info badge row p-1 insert-q text-center">Dodaj pitanje</span>
</div>
<div class="content container">
    <div class="row justify-content-start ">
    <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $questionNo => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card m-2 row mb-auto">
                            <div class="card-header p-1">
                                <div class="float-left">
                                    <span data-category='<?php echo e($question->category_id); ?>' data-question="<?php echo e($question->id); ?>"  class="question  badge"><?php echo e($question->question); ?></span>
                                </div>
                                <div class="float-right">
                                    <span data-question-name="<?php echo e($question->question); ?>" data-question="<?php echo e($question->id); ?>" class=" badge btn-primary edit-q"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                    <span data-question="<?php echo e($question->id); ?>" class="btn-danger delete-q badge"><i class="fa fa-times" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div class="card-body p-1">
                                <?php $__currentLoopData = $question->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="clearfix"></div>
                                        <?php if($answer->true === 1): ?>
                                            <div class="float-left">
                                                <input id="<?php echo e($answer->id); ?>" data-category='<?php echo e($question->category_id); ?>' data-question="<?php echo e($question->id); ?>" data-id="<?php echo e($answer->id); ?>" name="<?php echo e($question->id); ?>" type="radio" class="radio align-content-center " checked="checked"/>
                                                <label class="bg-success text-white badge" for="<?php echo e($answer->id); ?>"><?php echo e($answer->answer); ?></label>
                                            </div>
                                        <?php else: ?>
                                            <div class="float-left">
                                                <input id="<?php echo e($answer->id); ?>" data-category='<?php echo e($question->category_id); ?>' data-question="<?php echo e($question->id); ?>" data-id="<?php echo e($answer->id); ?>" name="<?php echo e($question->id); ?>" type="radio" class="radio align-content-center"/>
                                                <label class="badge" for="<?php echo e($answer->id); ?>"><?php echo e($answer->answer); ?></label>
                                            </div>
                                        <?php endif; ?>
                                            <?php if($answer->true === 1): ?>
                                                <div class="float-right">
                                                    <span class=" badge edit-a btn-primary" data-category='<?php echo e($question->category_id); ?>' data-id="<?php echo e($answer->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                                    <span class="btn-danger restrict-a-true badge"><i class="fa fa-times" aria-hidden="true"></i></span>
                                                </div>
                                            <?php elseif(count($question->answers) < 3): ?>
                                                <div class="float-right">
                                                    <span class=" badge edit-a btn-primary" data-category='<?php echo e($question->category_id); ?>' data-id="<?php echo e($answer->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                                    <span class=" btn-danger restrict-a badge"><i class="fa fa-times" aria-hidden="true"></i></span>
                                                </div>
                                            <?php else: ?>
                                                <div class="float-right ">
                                                    <span class=" badge edit-a btn-primary" data-category='<?php echo e($question->category_id); ?>' data-id="<?php echo e($answer->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                                    <span class="btn-danger delete-a badge" data-category='<?php echo e($question->category_id); ?>' data-id="<?php echo e($answer->id); ?>"><i class="fa fa-times " aria-hidden="true"></i></span>
                                                </div>
                                            <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="card-footer p-1 d-flex justify-content-around">
                                <?php if(count($question->answers) > 5): ?>
                                    <span class="bg-warning badge">Maksimalan broj odgovora je 6</span>
                                <?php else: ?>
                                    <span data-question="<?php echo e($question->id); ?>" class="btn add-a btn-success badge" data-category='<?php echo e($question->category_id); ?>'>Dodaj odgovor</span>
                                <?php endif; ?>
                            </div>
                        </div>



































    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('functions'); ?>
    <script src="<?php echo e(asset("/")); ?>js/functions.js"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset("/")); ?>js/moderator/questions.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Desktop\Quiz\resources\views/pages/moderator-questions.blade.php ENDPATH**/ ?>