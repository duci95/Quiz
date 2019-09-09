$("#logBtn").on("click", function(){
    let email = $("#emailLog");
    let password = $("#password");
    let errors = [];

    if(!reEmail.test(email.val()))
        errors.push("Email nije u ispravnom formatu");

    if(!rePassword.test(password.val()))
        errors.push("Lozinka nije u ispravnom formatu");


});

