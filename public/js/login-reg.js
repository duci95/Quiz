$("#reg-link").on('click', function registrationForm(){
    $("#fade1").fadeOut("slow", function() {
        $("#fade1").addClass("d-none");
        $("#fade2").removeClass("d-none");
        $("#fade2").css("display", "block");
    });
});
$("#log-link").on('click', function loginForm(){
    $("#fade2").fadeOut("slow", function() {
        $("#fade1").removeClass("d-none");
        $("#fade1").css("display", "block");
    });
});
//REGISTRATION
const firstname = $("#firstname");
const lastname = $("#lastname");
const email = $("#email");
const password = $("#pass");
const passwordCheck = $("#passwordc");
const registrationBtn = $("#regBtn");

const reFirstLast = /^([A-ZŠĐČĆŽ][a-zšđčćž\-']{2,20})(\s[A-ZŠĐČĆŽ][a-zšđčćž\-']{2,20})*$/;
const rePassword =  /^[A-ZŠĐČĆŽa-zšđčćž?!&^#|$%@*\/0-9]{8,15}$/;
const reEmail = /^[^@\s]{3,25}@[^@\s]{2,10}\.[^@\s]{2,7}$/;

const errors = [];



registrationBtn.on("click", function() {
    const animationRoot = $("#animate-div");
    const file = document.getElementById("img").files[0];
    const fileName = file.name;
    const fileExtension = fileName.split(".").pop().toLowerCase();
    const permittedExtensions = ["gif", "png", "bmp", "jpg", "jpeg", "tiff"];

    if(!reFirstLast.test(firstname.val()))
        errors.push("Ime ne može imati manje od 2 i duže od 20 karaktera");

    if(!reFirstLast.test(lastname.val()))
        errors.push("Prezime ne može imati manje od 2 i više od 20 karaktera");

    if(!reEmail.test(email.val()))
        errors.push("Email nije u dobrom formatu");

    if(!rePassword.test(password.val())){
        errors.push("Lozinka ne može imati manje od 8 i više od 15 karaktera")
    }
    if(password.val() !== passwordCheck.val())
        errors.push("Lozinke se ne podudaraju");

    if(!jQuery.inArray(fileExtension, permittedExtensions)){
        var permittedExtensionsString = "";
        $.each(permittedExtensions, function(index, value){
            permittedExtensionsString+= value + " ";
        });
        errors.push("Dozvoljenje ekstenzije su:" + permittedExtensionsString);
    }
    if(file.size > 3000000)
        errors.push("Slika ne sme biti veca od 3 MB");

    else{
        var form = new FormData();
        form.append("image", file);

        form.append("firstname", firstname.val());
        form.append("lastname", lastname.val());
        form.append("email", email.val());
        form.append("password", password.val());
        form.append("passwordCheck", passwordCheck.val());

        $.ajaxSetup({
            headers : {
                "X-CSRF-TOKEN" : $("meta[name='_token']").attr("content")
            }
            ,
            accept : "application/json"
        });
        $(document).ajaxStart(function(){
            animationRoot.addClass("animate");
        });
        $.ajax({
            url: "/register",
            method: "POST",
            dataType: "JSON",
            data: form,
            cache : false,
            processData : false,
            contentType : false,
            beforeSend:function(){
                console.log("animacija");
                //koristiti animaciju koristeci animate translation on
            },
            success: function(response){
                console.log("uspesno i ide bootbox probaj");
            },
            error: function (xhr, status, error) {
                console.log("probaj i ovde bootbox samo da ima smisla");
            },
            complete: function(){
                animationRoot.removeClass("animate");
            }
        })
    }
});
