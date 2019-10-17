function showModalAfterTestCompleted(message , numberOfCorrects , numberOfQuestions ){
    bootbox.dialog({
        message:  `<span class="d-flex justify-content-center">${message} <br/>  Broj tačnih odgovora : ${numberOfCorrects}  od  ${numberOfQuestions} </span>`,
        closeButton: false,
        buttons: {
            ok: {
                label: 'U redu',
                className: 'btn-info',
                callback: function () {
                    window.location.href = `/home`;
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
    var minutesLeft = 19;
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
    }, 1000);
}
function printCategoriesAfterAjax(data){
    var element ='';
    $.each(data, function(index, item){
        element+=`<div class="row justify-content-center border-bottom border-top p-2 m-2">
                    <span class="col-2 row justify-content-start">
                        <a href='http://127.0.0.1:8000/categories/one/${item.id}' class="text-white btn badge p-2 mr-3 btn-info">${item.category_name}</a>
                        <a href='http://127.0.0.1:8000/statistics/${item.id}' class="text-white badge btn p-2 btn-info">Rezultati</a>
                    </span>
                    <span class="col-6 row justify-content-center align-content-center">
                        <span class="text-info badge">${item.description}</span>
                    </span>
                    <span class="col-3 row justify-content-end">
                        <span data-category="${item.id}" class="mr-2 edit btn btn-primary badge p-2 ">Izmeni</span>
                    <span data-category="${item.id}" class="delete btn btn-danger  badge p-2  ">Obriši</span>
                    </span>
                   </div> `;
    });
    $('.content').html(element);

}
function checkIfFieldsAreEmpty(field, errors){
    if (field.val() === '') {
        field.addClass('border-danger');
        errors.push(field);
    }
    else
        field.removeClass('border-danger');
}
function printQuestionsAndAnswersAfterAjax(data) {
    var element = `
    <div class="row ">`;
    for(var item of data) {
        element += `<div class="card m-2 p-0">
                        <div class="card-header p-1">
                            <span data-category='${item.category_id}' data-question="${item.id}" class="question p-1 badge">${item.question}</span>
                            <span class="btn badge ml-5 edit-q btn-primary" ><i  class="text-white fa fa-pencil-square-o" aria-hidden="true"></i></span>
                            <span data-category='${item.category_id}' data-question="${item.id}" class="btn btn-danger delete-q badge"><i class="fa fa-times" aria-hidden="true"></i></span>
                        </div>
                    <div class="card-body p-0">`;
        for (var answer of item.answers) {
            element += `<div class="justify-content-around p-0">`;
            if (answer.true === 1) {
                element += `<label class="bg-success text-white badge" for="${answer.id}">${answer.answer}</label>
                            <input id="${answer.id}" data-id="${answer.id}" name="${item.question}" type="radio" class="radio mr-1" checked="checked"/>`;
            }
            else {
                element += `<label class="p-1 badge" for="${answer.id}">${answer.answer}</label>
                            <input id="${answer.id}" data-id="${answer.id}" name="${item.question}" type="radio" class="radio m-1"/>`;
            }
            element+=`<span class="float-right">`;
            element += `<span class="btn badge mr-1 edit-a btn-primary" data-category='${item.category_id}' data-id="${answer.id}"><i class="fa fa-pencil-square-o" aria-hidden="true"> </i></span>`;
            if(answer.true === 1)
                element+= `<span class="btn btn-danger restrict-a-true badge" ><i class="fa fa-times" aria-hidden="true"> </i></span>`;
            else if(item.answers.length < 3)
                element+= `<span class="btn btn-danger restrict-a badge" ><i class="fa fa-times" aria-hidden="true"> </i></span>`;
            else
                element+=`<span class="btn btn-danger delete-a badge" data-category='${item.category_id}' data-id="${answer.id}"> <i class="fa fa-times" aria-hidden="true"> </i></span>`;
                element+=`</span>`;
            element += `</div>`;

        }
        element+=`</div>
                   <div class="card-footer p-1 d-flex justify-content-center">`;
        if(item.answers.length > 5)
            element+=`<span class="bg-warning badge">Maksimalan broj odgovora je 6</span>`;
        else
            element+=`<span data-category='${item.category_id}' data-question="${item.id}" class="btn btn-success add-a badge">Dodaj odgovor</span>`;
        element+=`</div> </div>`;
        $('.content').html(element);
    }
}
