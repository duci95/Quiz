$(document).on('click','.quiz',function() {
   var user = $(this).data("user");
   var category = $(this).data('category');
   var category_name = $(this).data('category-name');

   $.ajax({
      url : `/quiz/${user}/${category}`,
      method : "GET",
      success : function(response) {
          bootbox.dialog({
              title: category_name,
              message: `<p>Klikom na <i>Počni test </i>pokreće se test u trajanju od 20 minuta iz kategorije ${category_name} od maksimalno 10 pitanja, nema negativnih poena, postoji samo jedan tačan odgovor za svako pitanje. <strong>Srećno!!!</strong></p>`,
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
                   try {
                       if (request.responseJSON.results[0].trues >= request.responseJSON.results[1].questions / 2) {
                           bootbox.dialog({
                               title: `<span class="text-center">${category_name}</span>`,
                               message: `<p class='m-auto btn badge btn-success w-50 text-uppercase d-flex justify-content-center'>Položen</p>`,
                               size: "small"
                           });
                       } else {
                           console.log(request.responseJSON.results[1].questions);
                           bootbox.dialog({
                               title: `<span class="text-center">${category_name}</span>`,
                               message: ` <p class='m-auto btn badge btn-danger w-50 text-uppercase d-flex justify-content-center' >Nije položen</p>`,
                               size: "small"
                           });
                       }
                   }
                   catch(Exception){
                       bootbox.dialog({
                           title: `<span class="text-center">${category_name}</span>`,
                           message: `<p class='m-auto btn badge btn-danger w-50 text-uppercase d-flex justify-content-center'>Nije položen</p>`,
                           size: "small"
                       });
                   }
                   break;
               case 500 :
                   bootbox.dialog({
                           title: `<span class="text-center">${category_name}</span>`,
                           message: `<p class='m-auto btn badge btn-danger w-50 text-uppercase d-flex justify-content-center'>Nije položen</p>`,
                           size: "small"
                       });
                   break;
           }
       }
   });
});
