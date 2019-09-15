$("#recoveryBtn").on("click", function(){
    let email = $("#emailRecovery");
    let errors = [];
    checkForInputErrors(reEmail, email, errors, emailWarning);
    printErrors(errors);

    if(errors.length)
        return;

    animation();

    $.ajax({
      url : "/recovery",
      method : "POST",
      dataType : "JSON",
      data : {"email" : email.val()},
      success : function(){

      },
      errors : function(){

      }
    });
});
