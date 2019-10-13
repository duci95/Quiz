$("#logBtn").on("click", function(){
    let email = $("#emailLog");
    let password = $("#password");
    let errors = [];

    checkForInputErrors(reEmail, email,errors, emailWarning);
    checkForInputErrors(rePassword, password,errors, passwordWarning);

    printErrors(errors);
    if(errors.length)
        return;
    $(".errors").empty();
    var objectToSend = {};
    objectToSend.email = email.val();
    objectToSend.password = password.val();
    sendCSRFToken();
    animation();
    $.ajax({
       url : "/login",
       method : "POST",
       data : objectToSend,
       success : function(response){
            window.location.href = '/home';
       },
       error: function(xhr, status, error){
            switch(xhr.status){
                case 404:
                    $(".errors").html('Pogrešan email/lozinka!');
                    break;
                case 403:
                    $(".errors").html('Profil nije aktiviran! <br/> Poslat je ponovo email sa aktvacionim linkom!');
                    break;
                default:
                    $(".errors").html("Trenutno nije moguće prijavljivanje, pokušaj kasnije!");
                    break;
            }
       }
    });
});
