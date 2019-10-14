$(document).ready(function (){
   $(document).on('click','.radio',function(){
      const question_id = $(this).parent().parent().parent().find('.question').data('question');
      const category_id = $(this).parent().parent().parent().find('.question').data('category');
      const answer = $(this).data('id');
      sendCSRFToken();
      $.ajax({
         url : "/answers/"+answer,
         method : 'PUT',
         data : {
            'question_id' : question_id,
             'category_id' : category_id
         },
         success : function(response){

         },
         error : function() {

         }
      });
   });
});
