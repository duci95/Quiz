$(document).on('click','.quiz',function(e) {

   var user = $(this).data("user");
   var category = $(this).data('category');
   var category_name = $(this).data('category-name');

   $.ajax({
      url : `/quiz/${user}/${category}`,
      method : "GET",
      success : function(response) {
          bootbox.dialog({
              title: category_name,
              message: `<p>Klikom na <i>Počni test</i></p>`,
              buttons: {
                  cancel: {
                      label: "Odustani",
                      className: 'btn-secondary'
                  },
                  confirm: {
                      label: `<a>Počni test</a>`,
                      className: 'btn-info',
                      callback: function () {
                          window.location.href = `/test/${category}`;
                      }
                  }
              }
          });
      },
      error:function(request,status, error) {
           switch (request.status) {
               case 401 :
                   bootbox.dialog({
                       title: `<span class="text-center">${category_name}</span>`,
                       message: `<p class='m-auto btn badge btn-success w-50 text-uppercase d-flex justify-content-center'>Test je vec radjen</p>`,
                       size: "small"
                   });
               case 409 :
                   if(request.responseJSON.results[0].trues > request.responseJSON.results[0].questions / 2) {
                       bootbox.dialog({
                           title: `<span class="text-center">${category_name}</span>`,
                           message: `<p class='m-auto btn badge btn-success w-50 text-uppercase d-flex justify-content-center'>Položen</p>`,
                           size: "small"
                       });
                   }
                   else{
                       bootbox.dialog({
                           title: `<span class="text-center">${category_name}</span>`,
                           message:` <p class='m-auto btn badge btn-danger w-50 text-uppercase d-flex justify-content-center' >Nije položen</p>`,
                           size: "small"
                       });
                   }
                   break;
               case 500 :
                   bootbox.alert('Trenutno nije moguće raditi test, pokušaj kasnije');
                   break;
           }
       }
   });
});
