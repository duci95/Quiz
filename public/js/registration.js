$("#regBtn").on("click",function() {
    $("#reg-success").html('');
    let firstname = $("#firstname");
    let lastname = $("#lastname");
    let password = $("#pass");
    let passwordCheck = $("#passwordc");
    let errors = [];
    let image = $('#img');
    let file = image.prop('files')[0];
    let email = $("#email");

    checkForInputErrors(reFirstLast, firstname, errors, firstnameWarning);
    checkForInputErrors(reFirstLast, lastname, errors, lastnameWarninig);
    checkForInputErrors(reEmail, email, errors, emailWarning);
    checkForInputErrors(rePassword, password, errors, passwordWarning);

    checkForPasswordsMatching(password, passwordCheck, errors);

    validatePicture(image, errors);

    printErrors(errors);

    if(errors.length)
        return;

    $(".errors").empty();
    var form = new FormData();
    form.append("image", file);

    form.append("firstname", firstname.val());
    form.append("lastname", lastname.val());
    form.append("email", email.val());
    form.append("password", password.val());
    form.append("passwordCheck", passwordCheck.val());

    sendCSRFToken();
    animation();
    $.ajax({
        url : "register",
        method : "POST",
        data : form,
        cache : false,
        processData : false,
        contentType : false,
        success: function (response) {
            $("#reg-success").html
            (`
                <strong>Poslat je mejl sa aktivacionim linkom!</strong>
            `)
        },
        error: function (xhr, status, error) {
            switch(xhr.status)
            {
                case 409:
                    $('.errors').html('Već postoji korisnik sa mejlom ' + email.val());
                    break;

                case 500:
                    $('.errors').html('Trenutno nije moguće registrovanje, pokušaj kasnije');
                    break;
            }
        }
    });
});
