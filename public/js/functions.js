function loginForm() {
        $("#fade2").fadeOut("slow", function () {
            $("#fade3").addClass("d-none");
            $("#fade2").addClass("d-none");
            $("#fade1").removeClass("d-none");
            $("#fade1").css("display", "block");
            $(".errors").empty();
        });
}
function registrationForm() {
    $("#fade1").fadeOut("slow", function () {
        $("#fade1").addClass("d-none");
        $("#fade3").addClass("d-none");
        $("#fade2").removeClass("d-none");
        $("#fade2").css("display", "block");
        $(".errors").empty();
    });
}
function passwordRecoveryForm() {
    $("#fade1").fadeOut("slow", function () {
        $("#fade3").css("display", "block");
        $("#fade1").addClass("d-none");
        $("#fade3").removeClass("d-none");
        $(".errors").empty();
    });
}
function loginFormFromPasswordRecoveryForm(){
    $("#fade3").fadeOut("slow", function () {
        $("#fade3").addClass("d-none");
        $("#fade1").removeClass("d-none");
        $("#fade1").css("display", "block");
        $(".errors").empty();
    });
}
function registrationFormFromPasswordRecoveryForm(){
    $("#fade3").fadeOut("slow", function () {
        $("#fade3").addClass("d-none");
        $("#fade2").removeClass("d-none");
        $("#fade2").css("display", "block");
        $(".errors").empty();
    });
}
function checkForInputErrors(regex, element, array, message){
    if(!regex.test(element.val())) {
        array.push(message);
        element.addClass("border-danger");
    }
    else{
        element.removeClass("border-danger");
    }
}
function checkForPasswordsMatching(password, passwordAgain, array){
    if(password.val() !== passwordAgain.val()) {
        array.push("Lozinke se ne podudaraju");
        password.addClass("border-danger");
        passwordAgain.addClass("border-danger");
    }
    else{
        password.removeClass("border-danger");
        passwordAgain.removeClass("border-danger");
    }
}
function validatePicture(image, array){
    var file = null;
    if(image.value === ""){
        array.push("Slika nije odabrana");
    }
    else{
        file = image.files[0];
        const fileName = file.name;
        const fileExtension = fileName.split(".").pop().toLowerCase();

        var validExtension = true;
        if(!permittedExtensions.includes(fileExtension))
        {
            let permittedExtensionsString = "";
            validExtension = false;
            $.each(permittedExtensions, function(index, value){
                permittedExtensionsString+= value + " ";
            });
            array.push("Dozvoljene ekstenzije slike su: <span class='text-uppercase '> " + permittedExtensionsString + "</span>");
        }
        if(file.size > 3000000 && validExtension === true ) {
            array.push("Slika ne sme biti veca od 3 MB");
        }
    }
}
function printErrors(array)
{
    if (array.length > 0) {
        let error = "";
        for (let item of array) {
            error += `<span class='text-white h6'>${item}</span> <br/>`;
        }
        $(".errors").html(error);
    }
}
function animation(){
    $(document).ajaxStart(function () {
        $(".animate-div").addClass("animate");
    });
    $(document).ajaxStop(function () {
        $(".animate-div").removeClass("animate");
    });
}
function sendCSRFToken(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='_token']").attr("content")
        },
        accept: "application/json"
    });
}
