// var dialog1 = bootbox.dialog({
//     message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i> Please wait while we do something...</p>',
//     closeButton: false
// });

$(document).on('click','.quiz',function(e) {

   var user = $(this).data("user");
   var category = $(this).data('category');
   var category_name = $(this).data('category-name');
   var token = $(this).data('category-token');
   console.log(token);

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
               case 409 :
                   bootbox.dialog({
                       title: `${category_name}`,
                       message: "<p class='text-center text-danger p-1'>Ovaj test je radjen</p>",
                       size: "small",
                       buttons: {
                           cancel: {
                               label: "Zatvori",
                               className: 'btn-info text-center',
                               callback: function () {
                                   console.log('Custom cancel clicked');
                               }
                           },
                       }
                   });
                   break;
               case 500 :
                   bootbox.alert('Trenutno nije moguće raditi test, pokušaj kasnije');
                   break;
           }
       }
   });
});
