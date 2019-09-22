$("#regBtn").on("click",function() {
    let firstname = $("#firstname");
    let lastname = $("#lastname");
    let password = $("#pass");
    let passwordCheck = $("#passwordc");
    let errors = [];
    let image = document.getElementById("img");
    let file = image.files[0];
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
        url : "/register",
        method : "POST",
        dataType : "JSON",
        data : form,
        cache : false,
        processData : false,
        contentType : false,
        success: function (response) {
            console.log("uspesno i ide bootbox probaj");
        },
        error: function (xhr, status, error) {
            console.log("probaj i ovde bootbox samo da ima smisla");
        },
        complete : function () {
            $("#reg-success").removeClass("d-none");
        }
    });
});
