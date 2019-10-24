$(document).ready(function (){
   $(document).on('click','.save',function(){
       const firstname = $("#firstname");
       const lastname = $("#lastname");
       const email = $("#email");
       const password = $("#new-password");
       const password_again = $("#new-password-again");
       const image = $('#img');
       const user = $(this).data('id');
       const errors = [];

       checkForInputErrors(reFirstLast,firstname,errors,firstnameWarning);
       checkForInputErrors(reFirstLast,lastname,errors,firstnameWarning);
       checkForInputErrors(reEmail,email,errors,emailWarning);

       if(password.val() !== '') {
           checkForInputErrors(rePassword, password, errors, passwordWarning);
           checkForPasswordsMatching(password, password_again, errors);
       }

       if(image.val() !== '') {
           validatePicture(image, errors);
       }


       if(errors.length > 0) {
           for (let i = errors.length - 1; i < errors.length; i--) {
               $.notify(errors[i]);
           }
       }


       else{
           const edited = new FormData();

           if(image.val() !== ""){
               const file =  image.prop('files')[0];
               edited.append('image',file);
           }

           if(password.val() !== ''){
               edited.append('password',password.val());
               edited.append('password_again',password_again.val());
           }

           edited.append('firstname', firstname.val());
           edited.append('lastname',lastname.val());
           edited.append('email',email.val());
           edited.append('_method','PUT');

           sendCSRFToken();

           $.ajax({
               url : '/users/'+ user,
               method : "POST",
               data : edited,
               cache : false,
               processData : false,
               contentType : false,
               success : function(response){
                   $('.modal').modal('hide');
                   $.notify("Uspešna izmena!",{
                       position: "bottom right",
                       className : 'success'
                   });
               },
               error:function(r,s,e){
                   $.notify("Izmena nije uspešna!",{
                       position: "bottom right",
                       className : 'error'
                   });
               }
           });
       }
   });
});