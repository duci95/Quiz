<div class="modal fade d-none" id="quizModalSuccess" tabindex="-1"  role="dialog" aria-labelledby="quizModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quizModalLabel"><?php echo e($cat->category_name); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="h6 p-1 modalText">Klikom na <i>Počni test</i> započinjete test u trajanju od 30 minuta</p>
                <p class="h6 p-1 modalText"> Svaki izlazak iz testa biće razmatrano kao predaja testa <br/></p>
                <p class="h6 p-1 modalText">Test se može raditi jednom u 6 meseci</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
                <a href="<?php echo e(route('quiz', ['id' => $cat->id])); ?>" class="btn btn-primary text-white">Počni test</a>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\Dusan\Quiz\resources\views/modals/quiz.blade.php ENDPATH**/ ?>