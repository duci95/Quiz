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
      const category_id = $(this).prev().data('category');
      console.log(category_id);
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
                             "question" : new_question,
                             'category' : category_id
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
   $(document).on('click','.add-a',function(){
       var question = $(this).data('question');
       var category = $(this).data('category');
       console.log(question);
       console.log(category);
       bootbox.dialog({
           title: "Dodaj odgovor",
           message : '<input id="answer_text" class="form-control" type="text">',
           buttons:{
               cancel:{
                    label : 'Odustani',
                    className : 'btn-secondary'
               },
               ok:{
                   label: "Sačuvaj",
                   className : 'btn-success',
                   callback : function(){
                       const errors = [];
                       const field = $('#answer_text');
                       checkIfFieldsAreEmpty(field, errors);
                       if(errors.length > 0)
                           return false;
                       sendCSRFToken();
                       $.ajax({
                           url : '/answers',
                           method : "POST",
                           data:{
                               'answer' : field.val(),
                               'question' : question,
                               'category' : category
                           },
                           success: function(response){
                               printQuestionsAndAnswersAfterAjax(response.results);
                               $.notify('Pitanje uspešno dodato!',{
                                   className : 'success',
                                   position : 'bottom right'
                               });
                           },
                           error: function(r,s,e){
                               $.notify('Pitanje nije dodato!',{
                                   className : 'error',
                                   position : 'bottom right'
                               })
                           }
                       })
                   }
               }
           }
       })
   });
   $(document).on('click','.delete-a',function(){
       const answer = $(this).data('id');
       const category = $(this).data('category');
       bootbox.dialog({
           title : 'Brisanje pitanja',
           message: 'Da li ste sigurni?',
           buttons : {
               cancel:{
                   className : 'btn-secondary',
                   label : 'Odustani'
               },
               ok:{
                   className: 'btn-danger',
                   label: 'Obriši',
                   callback: function(){
                       sendCSRFToken();
                    $.ajax({
                        url : '/answers/'+answer,
                        method : "DELETE",
                        success: function(response){
                            $.ajax({
                                url : '/categories/'+ category,
                                method : 'GET',
                                success : function(response){
                                    printQuestionsAndAnswersAfterAjax(response.results);
                                    $.notify('Odgovor uspešno obrisan!',{
                                        position : 'bottom right',
                                        className : 'success'
                                    })
                                }
                            });

                        },
                        error:function(r,s,e){
                            $.notify('Odgovor nije obrisan!',{
                                position : 'bottom right',
                                className : 'error'
                            })
                        }
                    })
                   }
               }
           }
       });
   });
   $(document).on('click','.restrict-a',function(){
      bootbox.alert('Minimalan broj odgovora je 2!');
   });
   $(document).on('click','.restrict-a-true',function(){
       bootbox.alert('Nije moguće brisanje tačnog odgovora');
   });
   $(document).on('click','.delete-q',function(){
       const category = $(this).data('category');
       const question = $(this).data('question');
       sendCSRFToken();
       bootbox.dialog({
          title:`<span class="h5">Brisanje pitanja</span>`,
          message: 'Da li ste sigurni da želite da obrišete pitanje i odgovore?',
          buttons:{
              cancel:{
                  className:'btn-secondary',
                  label : 'Odustani'
              },
              ok:{
                  className:'btn-danger',
                  label:'Obriši',
                  callback:function(){
                      sendCSRFToken();
                      $.ajax({
                          url: '/questions/' + question,
                          method: "DELETE",
                          success: function () {
                              $.ajax({
                                  url: '/categories/' + category,
                                  method: "GET",
                                  success: function (response) {
                                      printQuestionsAndAnswersAfterAjax(response.results);
                                      $.notify('Pitanje uspešno obrisano!', {
                                          position: 'bottom right',
                                          className: 'success'
                                      })
                                  }
                              });
                          },
                          error:function(){
                              $.notify('Pitanje nije obrisano!',{
                                  position : 'bottom right',
                                  className : 'error'
                              })
                          }
                      });
                  }
              }
          }
       });

   });
   $(document).on('click','.insert-q',function(){
      const category = $(this).data('category');
      console.log(category);
      bootbox.dialog({
          title: 'Dodaj pitanje',
          message:`<label for="question">Pitanje</label>
                   <input type="text" id="question" class="form-control mb-2"/>
                   
                   <label for="right" class="text-success">Tačan odgovor</label>
                   <input type="text" id="right" class="form-control"/>
                   
                   <label for="wrong" class="text-danger">Pogrešan odgovor</label>
                   <input type="text" id="wrong" class="form-control"/>                      
                  `,
          buttons: {
              cancel: {
                  label: "Odustani",
                  className : 'btn-secondary',
              },
              ok:{
                  label:"Sačuvaj",
                  className:'btn-success',
                  callback: function(){
                      const errors = [];
                      const question = $("#question");
                      const right = $('#right');
                      const wrong = $('#wrong');
                      checkIfFieldsAreEmpty(question,errors);
                      checkIfFieldsAreEmpty(right,errors);
                      checkIfFieldsAreEmpty(wrong,errors);
                      if(errors.length > 0)
                          return false;
                      sendCSRFToken();
                      $.ajax({
                          url : '/questions',
                          method : "POST",
                          data:{
                              'question' : question.val(),
                              'right' : right.val(),
                              'wrong' : wrong.val(),
                              'category' : category
                          },
                          success:function(response){
                              printQuestionsAndAnswersAfterAjax(response.results);
                              $.notify('Pitanje i odgovori uspešno dodati!', {
                                  position: 'bottom right',
                                  className: 'success'
                              })
                          },
                          error:function(r,s,e){
                              $.notify('Pitanje i odgovori nisu dodati!', {
                                  position: 'bottom right',
                                  className: 'error'
                              })
                          }
                      })
                  }
              }
          }
      })
   });
});
