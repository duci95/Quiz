$(document).ready(function(){

   $(document).on('click','.save',function(){
      const errors = [];
      const first_name = $(this).parent().parent().find('#firstname');
      const last_name = $(this).parent().parent().find('#lastname');
      const email = $(this).parent().parent().find('#email');
      const password = $(this).parent().parent().find('#new-password');
      const password_again = $(this).parent().parent().find('#new-password-again');
      const img = $(this).parent().parent().find('#img');
      const role = $(this).parent().parent().find('#role').val();
      const blocked = $(this).parent().parent().find('#blocked').val();
      const active = $(this).parent().parent().find('#active').val();
      const admin =  $(this).data('id');
      console.log(role);
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
              data.append("image_new", img.val());
          }
          if(password.val !== '') {
              data.append("password", password.val());
              data.append("passwordCheck", password_again.val());
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
                success:function(){

                },
                error:function(){

                }
            })
      }
      // $('.modal').modal('hide');
   });
});
