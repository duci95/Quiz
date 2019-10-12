function showModalAfterTestCompleted(message , numberOfCorrects , numberOfQuestions ){
    bootbox.dialog({
        message:  `<span class="d-flex justify-content-center">${message} <br/>  Broj tačnih odgovora : ${numberOfCorrects}  od  ${numberOfQuestions} </span>`,
        closeButton: false,
        buttons: {
            ok: {
                label: 'U redu',
                className: 'btn-info',
                callback: function () {
                    window.location.href = `/`;
                }
            }
        }
    });
}

function showModalOnAjaxRequestAnimation(){
    $(document).ajaxStart(function(){
        bootbox.dialog({
            message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i> Molimo sačekajte... </p>',
            size: 'small',
            closeButton: false
        });
    });
}
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
        $(".errors").empty();
    }
}
function checkForPasswordsMatching(password, passwordAgain, array){
    passwordAgain.removeClass('border-danger');
    if(password.val() !== passwordAgain.val()) {
        array.push(matchingPasswordsWarning);
        passwordAgain.addClass('border-danger');
    }
    else{
        passwordAgain.removeClass('border-danger');
        $(".errors").empty();
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
            array.push("Dozvoljene ekstenzije slike su: <span class='text-uppercase'> " + permittedExtensionsString + "</span>");
        }
        if(file.size > 3000000  && validExtension === true ) {
            array.push("Slika ne sme biti veća od 3 MB");
        }
    }
}
function printErrors(array) {
    if (array.length > 0) {
        let error = "";
        for (let item of array) {
            error += `<span class="h6 text-white">${item}</span> </br>`;
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
function goToLogin(){
    window.location.href = "/entry";
}

function sendAjaxRequestForTest() {
    const category = $('#category').data('category');
    const question_ids = $('input[name="questions[]"');
    const answers_ids = $('input[type="radio"]:checked');

    const questionIdsArray = [];
    const answersIdsArray = [];

    for(let i=0; i<question_ids.length; i++){
        questionIdsArray.push(question_ids[i].value);
    }

    for(let i = 0; i<answers_ids.length;i++){
        answersIdsArray.push(answers_ids[i].value)
    }

    sendCSRFToken();
    showModalOnAjaxRequestAnimation();
    const numberOfQuestions = questionIdsArray.length;
    $.ajax({
        url : '/quiz',
        method: 'POST',
        data:{
            'category' : category,
            'questions' : questionIdsArray,
            'answers_ids' : answersIdsArray
        },
        success:function(response) {
            const results = response.results;
            const corrects = [];
            $.each(results,function(index, value){
                if(value.true === 1){
                    corrects.push(value.true);
                }
            });
            const numberOfCorrects = corrects.length;
            if(numberOfCorrects >= questionIdsArray.length / 2)
                showModalAfterTestCompleted('Uspešno ste položili test!  ', numberOfCorrects, numberOfQuestions);
            else
                showModalAfterTestCompleted('Niste položili test! ' , numberOfCorrects, numberOfQuestions);
        },
        error: function(r, s, e) {
            showModalAfterTestCompleted('Niste odgovorili ni na jedno pitanje', 0,numberOfQuestions );
        }
});
}
function stopWatch() {
    var watch = document.getElementById('demo');
    var clicked = false;
    var button = document.getElementById('validate');
    button.addEventListener('click',function (){
       clicked = true;
    });
    watch.classList.add('bg-success');
    var minutesLeft = 0;
    var secondsLeft = 60;
    var time = setInterval(function () {
        secondsLeft -= 1;
        if (secondsLeft === -1 && minutesLeft !== 0) {
            minutesLeft -= 1;
            secondsLeft = 59;
        }
        watch.innerHTML = minutesLeft + ':' + secondsLeft;

        if (minutesLeft <= 2)
            watch.classList.add('bg-danger');
        if (secondsLeft < 10)
            watch.innerHTML = minutesLeft + ':' + 0 + secondsLeft;
        else if (minutesLeft < 10)
            watch.innerHTML = '0' + minutesLeft + ':' + secondsLeft;
        if (minutesLeft < 10 && secondsLeft < 10)
            watch.innerHTML = '0' + minutesLeft + ':' + '0' + secondsLeft;
        if (minutesLeft === 0 && secondsLeft === 0 || clicked) {
            clearInterval(time);
            sendAjaxRequestForTest();
        }
    }, 100);
}
