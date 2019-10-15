$(document).ready(function(){
    $(document).on('click','.edit',function(){
        const category = $(this).data('category');
        $.ajax({
            url : '/categories/'+ category + '/edit',
            method : 'GET',
            success : function(response){
                bootbox.dialog({
                    message : `<label for="category">Ime kategorije</label> <input type='text' id='category' class='form-control' value='${response.results.category_name}'/><br/>` +
                        `<label for='desc'>Opis</label><input type='text' id=desc class='form-control' value='${response.results.description}'/>`,
                    buttons:{
                        cancel:{
                            label:"Odustani",
                            className:'btn-secondary'
                        },
                        ok:{
                            label: "Sačuvaj",
                            className: 'btn-success',
                            callback:function(){
                                var new_cateogry = $('#category');
                                var new_desc = $("#desc");
                                checkIfFieldsAreEmpty(new_cateogry);
                                checkIfFieldsAreEmpty(new_desc);
                                sendCSRFToken();
                                $.ajax({
                                    url : '/categories/' + response.results.id,
                                    method : 'PUT',
                                    data:{
                                        'category' : new_cateogry.val(),
                                        'desc' : new_desc.val()
                                    },
                                    success:function(response){
                                        printCategoriesAfterAjax(response.results);
                                        $.notify("Kategorija uspešno izmenjena", {
                                            globalPosition: 'bottom right',
                                            className : 'success'
                                        } );
                                    },
                                    error:function(r, s,e){
                                        $.notify('Kategorija nije promenjena!',{
                                            globalPosition: 'bottom right',
                                            className : 'error'
                                        })
                                    }
                                })
                            }
                        }
                    },

                })
            }
        });
    });
    $(document).on('click','.delete',function(){
        const category = $(this).data('category');
        const categoryObject = $(this);
        const categoryText = categoryObject.prevAll()[2];
        console.log();
        bootbox.dialog({
            title : '<span class="h6">Da li ste sigurni da želite da obrišete kategoriju?</span>',
            message : `<span class="h4 d-flex justify-content-around">${categoryText.innerText}</span>`,
            buttons :{
                cancel:{
                    label : "Odustani",
                    className : 'btn-secondary',
                },
                ok :{
                    label : "Obriši",
                    className : 'btn-danger',
                    callback:function(){
                        sendCSRFToken();
                        $.ajax({
                            url : '/categories/' + category,
                            method : "DELETE",
                            success : function(response){
                            printCategoriesAfterAjax(response.results);
                            }
                        })
                    }
                }

            }
        })

    });
    $(document).on('click','.insert',function(){
       bootbox.dialog({
           title: 'Dodaj kategoriju',
           message:`<label for="category">Ime kategorije</label> <input type='text' id='category' class='form-control'/><br/>
               <label for='desc'>Opis</label><input type='text' id='desc' class='form-control'/>`,
           buttons :{
               cancel:{
                   label: 'Odustani',
                   className: 'btn-secondary'
               },
               ok:{
                   label : 'Dodaj',
                   className : 'btn-success',
                   callback : function() {
                       const name = $('#category');
                       const desc = $('#desc');
                       checkIfFieldsAreEmpty(name);
                       checkIfFieldsAreEmpty(desc);
                       sendCSRFToken();
                       $.ajax({
                           url : '/categories',
                           method : "POST",
                           data:{
                               'category' : name.val(),
                               'desc' : desc.val()
                           },
                           success: function(response){
                               printCategoriesAfterAjax(response.results);
                               $.notify('Kategorija uspešno dodata',{
                                   position : 'bottom right',
                                   className : 'success'
                               })
                           },
                           error:function(r,s,e){
                               if(r.status === 422){
                                   $.notify('Kategorija već postoji!',{
                                       position : 'bottom right',
                                       className : 'error'
                                   });
                               }
                           }
                       })
                   }

               }
           }
       })
    });
});
