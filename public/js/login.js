$("#logBtn").on("click", function(){
    let email = $("#emailLog");
    let password = $("#password");
    let errors = [];

    checkForInputErrors(reEmail, email,errors, emailWarning);
    checkForInputErrors(rePassword, password,errors, passwordWarning);

    printErrors(errors);
    if(errors.length > 0)
        return;

    var objectToSend = {};
    objectToSend.email = email.val();
    objectToSend.password = password.val();
    sendCSRFToken();
    animation();
    $.ajax({
       url : "/login",
       method : "POST",
       dataType : "JSON",
       data : objectToSend,
       success : function () {

       },
       error: function(){

       }
    });

});
