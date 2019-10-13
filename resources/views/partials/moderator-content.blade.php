<div class="row justify-content-around content border-bottom border-top p-2  m-2">
    <span class="col-2">
        <span class="text-white btn btn-info">{{$cat->category_name}}</span>
    </span>
    <span class="col-6">
        <span class="text-info">{{$cat->description}}</span>
    </span>
    <span data-category="{{$cat->id}}" class=" edit btn btn-primary">Izmeni</span>
    <span data-category="{{$cat->id}}" class="delete btn btn-danger d-flex justify-content-end ">Obriši</span>
</div>
@section('scripts')
    <script>
        $(".edit").click(function(){
           const category = $(this).data('category');

           $.ajax({
              url : '/categories/'+ category + '/edit',
              method : 'GET',
              success : function(response){

                  bootbox.dialog({
                      message : `<label for="category">Ime kategorije</label> <input type='text' id='category' class='form-control' value='${response.results.category_name}'/><br/>` +
                          `<label for='desc'>Opis</label><input type='text' id=desc class='form-control' value='${response.results.description}'/>`,
                      closeButton : false,
                      buttons:{
                          cancel:{
                              label:"Odustani",
                              className:'btn-secondary'
                          },
                          ok:{
                              label: "Sačuvaj",
                              className: 'btn-success',
                              callback:function(){
                                  var new_cateogry = $('#category').val();
                                  var new_desc = $("#desc").val();
                                  sendCSRFToken();
                                  $.ajax({
                                      url : '/categories/' + response.results.id,
                                      method : 'PUT',
                                      data:{
                                          'category' : new_cateogry,
                                          'desc' : new_desc
                                      },
                                      success:function(response){
                                          console.log(response);
                                          var element = '';
                                          $.each(response.results, function(index, item){
                                                   element+=`
                                                     <span class="col-2">
                                                         <span class="text-white btn btn-info">${item.category_name}</span>
                                                     </span>
                                                     <span class="col-6">
                                                         <span class="text-info">${item.description}</span>
                                                     </span>
                                                     <span data-category="${item.id}" class=" edit btn btn-primary">Izmeni</span>
                                                     <span data-category="${item.id}" class="delete btn btn-danger d-flex justify-content-end ">Obriši</span>
                                                   `;

                                          });
                                          $('.content').html(element);
                                      }
                                  })
                              }
                          }
                      },

                  })
              }
           });
        });
    </script>
@endsection
