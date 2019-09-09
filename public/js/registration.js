$("#regBtn").on("click",function() {
    let firstname = $("#firstname");
    let lastname = $("#lastname");
    let password = $("#pass");
    let passwordCheck = $("#passwordc");
    let errors = [];
    let image = document.getElementById("img");
    let file = image.files[0];
    let email = $("#email");
    let animationRoot = $(".animate-div");
    //probaj i proveru sifre da provuces ovde
    checkForInputErrors(reFirstLast, firstname, errors, firstnameWarning);
    checkForInputErrors(reFirstLast, lastname, errors, lastnameWarninig);
    checkForInputErrors(reEmail, email, errors, emailWarning);
    checkForInputErrors(rePassword, password, errors, passwordWarning);

    checkForPasswordsMatching(password, passwordCheck, errors);

    validatePicture(image, errors);

    printErrors(errors);


    var form = new FormData();
    form.append("image", file);

    form.append("firstname", firstname.val());
    form.append("lastname", lastname.val());
    form.append("email", email.val());
    form.append("password", password.val());
    form.append("passwordCheck", passwordCheck.val());

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='_token']").attr("content")
        },
        accept: "application/json"
    });
    $(document).ajaxStart(function () {
        animationRoot.addClass("animate");
    });
    $.ajax({
        url: "/register",
        method: "POST",
        dataType: "JSON",
        data: form,
        cache: false,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log("uspesno i ide bootbox probaj");
        },
        error: function (xhr, status, error) {
            console.log("probaj i ovde bootbox samo da ima smisla");
        },
        complete: function () {
            animationRoot.removeClass("animate");
        }
    });
});
