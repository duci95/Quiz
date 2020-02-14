$(document).ready(function(){
   $(document).on('click','.save', function(){
      const errors = [];
      const first_name = $(this).parent().parent().find('#firstname');
      const last_name = $(this).parent().parent().find('#lastname');
      const email = $(this).parent().parent().find('#email');
      const password = $(this).parent().parent().find('#new-password');
      const password_again = $(this).parent().parent().find('#new-password-again');
      const img = $(this).parent().parent().find('#img');
      const file = img.prop('files')[0];
      const role = $(this).parent().parent().find('#role').val();
      const blocked = $(this).parent().parent().find('#blocked').val();
      const active = $(this).parent().parent().find('#active').val();
      //admin is user_id but named admin because of laravel convention resources controller
      const admin =  $(this).data('id');
       console.log(blocked);
       console.log(active);

      const old = $(this).parent().parent().find('#img').data('prev-img');
      checkForInputErrors(reFirstLast,first_name,errors,firstnameWarning);
      checkForInputErrors(reFirstLast,last_name,errors,lastnameWarninig);
      checkForInputErrors(reEmail,email,errors,emailWarning);
      if(img.val() !== '') {
          validatePicture(img, errors);
      }
      if(password.val() !== '') {
          checkForInputErrors(rePassword, password, errors, passwordWarning);
          checkForPasswordsMatching(password, password_again, errors);
      }
      if(errors.length > 0) {
          for (let i = errors.length - 1; i < errors.length; i--) {
              $.notify(errors[i]);
          }
      }
      else{
          var data = new FormData();

          if(img.val() !== '') {
              data.append("image_new", file);
              data.append("image_old", old);
          }
          if(password.val().trim() !== '') {
              data.append("password", password.val().trim());
              data.append("password_again", password_again.val().trim());
          }

          data.append('firstname',first_name.val().trim());
          data.append("lastname", last_name.val().trim());
          data.append("email", email.val());

          data.append("blocked", blocked);
          data.append("active", active);
          data.append("role", role);

          data.append('_method','PUT');
          sendCSRFToken();

            $.ajax({
                url : "/admins/" + admin,
                method : "POST",
                data : data,
                cache : false,
                processData : false,
                contentType : false,
                success:function(response){
                    $('.modal').modal('hide');
                    printUsers(response.results);
                    $.notify('Uspešno izmenjen korisnik!',{
                        className : 'success',
                        position:'bottom right'
                    })
                },
                error:function(){
                    //$.notify('Trenutno nije moguće izmeniti korisnika!',{
                      //  className : 'error',
                        //position:'bottom right'
                    //})
                }
            })
      }

   });
   $(document).on('click','.delete',function(){
      const admin = $(this).data('id');
      sendCSRFToken();
      bootbox.dialog({
          title:"Brisanje korisnika",
          message:'Da li ste sigurni?',
          buttons:{
              cancel:{
                  label:"Odustani",
                  className : "btn-secondary"
              },
              ok:{
                  label:"Obriši",
                  className:'btn-danger',
                  callback:function(){
                      $.ajax({
                          url : '/admins/' + admin,
                          method:"DELETE",
                          success:function(response){
                              printUsers(response.results);
                              $.notify('Uspešno obrisan korisnik!',{
                                  className : 'success',
                                  position:'bottom right'
                              });
                          },
                          error:function(){
                              //$.notify('Trenutno nije moguće brisanje korisnika!',{
                                //  className : 'error',
                                  //position:'bottom right'
                              //})
                          }
                      })
                  }
              }
          }
      });
   });
   $(document).on('click','.add',function(){
      const errors = [];
      const first_name = $('#firstname-new');
      const last_name = $('#lastname-new');
      const email = $('#email-new');
      const password = $('#password-new');
      const password_again = $('#password-new-again');
      const image = $('#image-new');
      const files = image.prop('files')[0];
      const role = $('#role-new');
      const blocked = $('#blocked-new');
      const active = $('#active-new');

      checkForInputErrors(reFirstLast,first_name,errors,firstnameWarning);
      checkForInputErrors(reFirstLast,last_name,errors,lastnameWarninig);
      checkForInputErrors(reEmail,email,errors,emailWarning);
      checkForInputErrors(rePassword,password,errors,passwordWarning);
      checkForPasswordsMatching(password,password_again,errors);
      validatePicture(image,errors);
      checkIfDropDownListIsNotSelected(role,errors,roleWarning);
      checkIfDropDownListIsNotSelected(blocked,errors,blockedWarning);
      checkIfDropDownListIsNotSelected(active,errors,activeWarning);

      if(errors.length > 0){
          for(let i=errors.length-1;i<errors.length;i--){
              $.notify(errors[i]);
          }
      }
      else{
        const data = new FormData;
        data.append('firstname',first_name.val());
        data.append('lastname',last_name.val());
        data.append('email',email.val());
        data.append('password',password.val());
        data.append('password_again',password_again.val());
        data.append('image',files);
        data.append('role',role.val());
        data.append('blocked',blocked.val());
        data.append('active',active.val());

        sendCSRFToken();

        $.ajax({
            url : '/admins',
            method : 'POST',
            data : data,
            cache : false,
            processData : false,
            contentType : false,
            success : function(response){
                printUsers(response.results);
                $('.modal').modal('hide');
                $.notify('Uspešno dodat korisnik!',{
                    className : 'success',
                    position:'bottom right'
                });
            },
            error : function(){
                $('.modal').modal('hide');
                //$.notify('Trenutno nije moguće dodati korisnika!',{
                  //  className : 'error',
                    //position:'bottom right'
                //});
            }
        });
      }
   });
});