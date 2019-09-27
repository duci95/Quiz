$("#recoveryBtn").on("click", function(){
    let email = $("#emailRecovery");
    let errors = [];
    checkForInputErrors(reEmail, email, errors, emailWarning);
    printErrors(errors);

    if(errors.length)
        return;

    sendCSRFToken();
    animation();

    $.ajax({
      url : "recovery",
      method : "POST",
      dataType : "JSON",
      data : {"email" : email.val()},
      success : function(response) {
          $("#rec-success").html("Poslat je mejl sa pristupnim parametrom!");
      },
      errors : function(xhr, status, error) {
          // switch(xhr.status) {
          //     case 404:
                  $('.errors').html("Ne postoji korisnik sa mejlom " + email.val());
              //     break;
              // default:
              //     $('.errors').html("Trenutno nije moguće, pokušaj kasnije");
              //     break;
          }
      // }
    });
});