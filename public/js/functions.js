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
    if(!regex.test(element.val().trim())) {
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
    if(password.val().trim() !== passwordAgain.val().trim()) {
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
    if(image.val() === ""){
        array.push("Slika nije odabrana");
    }
    else{
        file = image.prop('files')[0];
        console.log(file);
        const fileName = file.name;
        console.log(fileName);
        const fileExtension = fileName.split(".").pop().toLowerCase();
        console.log(fileExtension);
        var validExtension = true;
        console.log(file.size);
        if(!jQuery.inArray(fileExtension))
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
            bootbox.alert("Nije ");
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
    }, 100);
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
function printUsers(data){
    var element = '';
    for(var item of data){
        element += `<div class="row justify-content-between border-bottom border-top p-1 m-2">
                <div class="row col-xl-1">
                        <img src="images/${item.picture.image_name}" alt="${item.picture.image_name.substring(0,10)}" title="{{substr($r->picture->image_name,0,10)}}">
                </div>
            <div class="row col-6 justify-content-start  align-content-center">
               <span class="badge p-2 btn-primary mr-3">${item.first_name} ${item.last_name}</span>
               <span class="badge p-2 btn-primary">${item.email}</span>
            </div>
            <div class="row justify-content-end col-4 align-content-center">`;
        if(item.is_blocked === 1)
            element+=`<span class="badge p-2 btn-warning text-white text-uppercase mr-3">Blokiran</span>`;
        if(item.active === 0)
           element+=`<span class="badge p-2 btn-secondary text-uppercase mr-3">Neaktivan</span>`;
        element+=`
            <span data-id="${item.id}" class="badge p-2 btn-primary btn edit text-uppercase mr-3 btn btn-primary" data-toggle="modal" data-target="#${item.id}">Izmeni</span>
            <span data-id="${item.id}" class=" text-uppercase text-white badge delete btn p-2 btn-danger">Obriši</span>
           </div>
        </div>
        
        <div class="modal fade" id="${item.id}" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="${item.id}" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="admin-edit-user">Izmena korisnika</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-6" id="firstname-div">
                            <label for="firstname" class="col-form-label text-muted">Ime</label>
                            <input type="text" class="form-control" id="firstname" value="${item.first_name}">
                        </div>
                        <div class="col-6">
                            <label for="lastname" class="col-form-label text-muted">Prezime</label>
                            <input type="text" class="form-control" id="lastname" value="${item.last_name}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="email" class="col-form-label text-muted text-muted">Email</label>
                            <input type="text" class="form-control" id="email" value="${item.email}">
                        </div>
                        <div class="col-6">
                            <label for="img" class="col-form-label text-muted">Slika</label>
                            <input type="file" accept="image/gif,image/jpeg,image/png"  class="form-control-file" id="img" data-prev-img="${item.picture.id}" >
                        </div>
                    </div>
                    <div class="row justify-content-between align-content-center">
                        <div class="col-6">
                            <label for="new-password" class="col-form-label text-muted">Nova lozinka</label>
                            <input type="password" class="form-control" id="new-password">
                        </div>
                        <div class="col-6">
                            <label for="new-password-again" class="col-form-label text-muted">Ponovi lozinku</label>
                            <input type="password" class="form-control" id="new-password-again" >
                        </div>
                    </div>
                    <div class="row justify-content-between align-content-center">
                        <div class="col-4">
                            <label for="blocked" class="col-form-label text-muted">Blokiranost</label>
                            <select id="blocked" class="form-control">`;
                                if(item.is_blocked === 1) {
                                    element += ` <option selected="selected" value="1">Blokiran</option>
                                <option value="0">Neblokiran</option>`;
                                }
                                else {
                                    element += `<option value="1">Blokiran</option>
                                <option selected="selected" value="0">Neblokiran</option>`;
                                }
                            element+=`</select>
                        </div>
                        <div class="col-4">
                            <label for="active" class="col-form-label text-muted">Status</label>
                            <select id="active" class="form-control">`;
                                 if(item.active === 1) {
                                     element += ` <option selected="selected" value="1">Aktivan</option>
                                    <option value="0">Neaktivan</option>`;
                                 }
                                else{
                                element+=` <option value="1">Aktivan</option>
                                <option selected="selected" value="0">Neaktivan</option>`;
                                }
                            element+=` </select>
                        </div>
                        <div class="col-4">
                            <label for="role" class="col-form-label text-muted">Uloga</label>
                            <select id="role" class="form-control">
                                
                                <option class="text-capitalize"`;
                                if(item.role_id === 1) {
                                    element += `selected="selected"`;
                                }
                                element+=`value="1">Administrator</option>`;
                                element+=`<option class="text-capitalize"`;
                                if(item.role_id === 2) {
                                    element += `selected="selected"`;
                                }
                                element+=`value="2">Moderator</option>`;
                                element+= `<option class="text-capitalize"`;
                                if(item.role_id === 3) {
                                    element+=`selected = "selected"`;
                                }
                                element+=`value="3">Regularni</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-id="${item.id}" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
                <button type="button" data-id="${item.id}" id="modal" class="btn btn-primary save">Sačuvaj</button>
            </div>
        </div>
    </div>
</div>
`;
    }
    $('.content').html(element);
}
function checkIfDropDownListIsNotSelected(list, array, message){
    if(list.val() === 'null'){
        array.push(message);
        list.addClass('border-danger')
    }
    else{
        list.removeClass('border-danger');
    }
}
