$(document).ready(function (){
   $(document).on('click','.radio',function(){
      const question_id = $(this).parent().parent().parent().find('.question').data('question');
      const category_id = $(this).parent().parent().parent().find('.question').data('category');
      const answer = $(this).data('id');
      sendCSRFToken();
      $.ajax({
         url : "/answers/trues/"+answer,
         method : 'PUT',
         data : {
            'question_id' : question_id,
            'category_id' : category_id
         },
         success : function(response){
             console.log(response.results);
             printQuestionsAndAnswersAfterAjax(response.results);
             $.notify('Tačan odgovor uspešno promenjen!',{
                 position : 'bottom right',
                 className : 'success'
             });
         },
         error : function() {
            $.notify('Tačan odgovor nije promenjen!',{
                position : 'bottom right',
                className : 'error'
            });
         }
      });
   });
   $(document).on('click','.edit-q',function(){
      const question_id = $(this).prev().data('question');
      var question_text = $(this).prev().prop('innerHTML');
      bootbox.dialog({
         title:'Izmena pitanja',
         message : `
        <input id="question_text" class="form-control" type="text" value="${question_text}">`,
        size:'medium',
        buttons :{
             cancel :{
                 label : "Odustani",
                 className : "btn-secondary"
             },
            ok:{
                 label : 'Sačuvaj',
                 className : 'btn-success',
                 callback : function(){
                     const new_question = $('#question_text').val();
                     sendCSRFToken();
                     $.ajax({
                         url : '/questions/'+question_id,
                         method : 'PUT',
                         data: {
                             "question" : new_question
                         },
                         success : function (response) {
                             printQuestionsAndAnswersAfterAjax(response.results);
                             $.notify('Pitanje uspešno promenjeno!',{
                                 position : 'bottom right',
                                 className : 'success'
                             });
                         },
                         error : function() {
                             $.notify('Pitanje nije promenjeno!',{
                                 position : 'bottom right',
                                 className : 'error'
                             });
                         }
                     })
                 }
            }
        }
      });
   });
   $(document).on('click','.edit-a',function(){
      const answer = $(this).data('id');
      const category = $(this).data('category');

      $.ajax({
          url: '/answers/'+ answer,
          method : 'GET',
          success : function(response){
              const answer_text = response.results.answer;
              const answer = response.results.id;
              bootbox.dialog({
                  title:'Izmena odgovora',
                  message : `
                    <input id="answer_text" class="form-control" type="text" value="${answer_text}">`,
                  size:'medium',
                  buttons : {
                      cancel:{
                          label : 'Odustani',
                          className : 'btn-secondary'
                      },
                      ok:{
                          label : 'Sačuvaj',
                          className : 'btn-success',
                          callback : function(){
                              var errros = [];
                              var text = $('#answer_text');
                              checkIfFieldsAreEmpty(text,errros);
                              if(errros.length > 0)
                                  return false;
                              sendCSRFToken();
                              $.ajax({
                                 url : '/answers/'+answer,
                                 method : 'PUT',
                                 data:{
                                     'answer' : text.val(),
                                     'category' : category
                                 },
                                 success:function(response){
                                     console.log(response.results);
                                     printQuestionsAndAnswersAfterAjax(response.results);
                                     $.notify('Pitanje uspešno promenjeno!',{
                                         position : 'bottom right',
                                         className : 'success'
                                     })
                                 },
                                 error : function(r,s,e){
                                     $.notify('Pitanje nije promenjeno!',{
                                         position : 'bottom right',
                                         className : 'error'
                                     })
                                 }
                              });
                          }
                      }
                  }
              })
          },
          error: function(){

          }
      });
   });
});
