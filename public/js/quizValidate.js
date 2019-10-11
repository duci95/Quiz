// function SendAjaxRequest()
// {
//         sendCSRFToken();
//         let category = $('#category').data('category');
//         let radios = $('input[type=radio]:checked');
//         $.ajax({
//             url : '/quiz',
//             method : 'post',
//             data:{
//                 'values' : radios,
//                 'category' : category
//             }
//         });
// }
stopWatch();

$('#validate').click(function(){

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
        const numberOfQuestions = questionIdsArray.length;
        console.log(numberOfCorrects);
        if(numberOfCorrects >= questionIdsArray.length/2){
            bootbox.alert('Uspešno ste položili test <br/> Broj tačnih odgovora : '+ numberOfCorrects + ' od ' + numberOfQuestions);

        }
        else{
            bootbox.alert('Niste položili test');
        }
        //samo bootbox dialog a ne alert kako bi ga prebacio na drugu stranu u callbacku
       },
       error: function(r, s, e) {
           console.log('Greska');
       }
    });
});