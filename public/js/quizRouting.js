// var dialog1 = bootbox.dialog({
//     message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i> Please wait while we do something...</p>',
//     closeButton: false
// });

$(document).on('click','.quiz',function(e) {

   var user = $(this).data("user");
   var category = $(this).data('category');
   var category_name = $(this).data('category-name');

   $.ajax({
      url : `/quiz/${user}/${category}`,
      method : "GET",
      success : function(response){
          if(!response.data[0]) {
              bootbox.dialog({
                  title: category_name,
                  message: `<p>Klikom na <i>Počni test</i></p>`,
                  buttons: {
                      cancel: {
                          label: "Odustani",
                          className: 'btn-secondary'
                      },
                      ok: {
                          label: 'Počni test',
                          className: 'btn-info',
                          callback: function () {
                              sendCSRFToken();
                              $.ajax({
                                  url : `/test/${category}`,
                                  method:'GET',
                                  data:{
                                      'user' : user,
                                      'category' : category
                                  },
                                  complete:function(response){
                                        // window.location.href= `/test/one`
                                  }
                              });
                          }
                      }
                  }
              });
          }
          else{
              bootbox.dialog({
                  title: `${category_name}`,
                  message: "<p class='text-center text-danger p-1'>Ovaj test je radjen</p>",
                  size:"small",
                  buttons: {
                      cancel: {
                          label: "Zatvori",
                          className: 'btn-info text-center',
                          callback: function() {
                              console.log('Custom cancel clicked');
                          }
                      },
                  }
              });
          }
      }
   });
});
