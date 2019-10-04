var dialog1 = bootbox.dialog({
    message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i> Please wait while we do something...</p>',
    closeButton: false
});

const dialog = bootbox.dialog({
    title: 'A custom dialog with buttons and callbacks',
    message: "<p>This dialog has buttons. Each button has it's own callback function.</p>",
    buttons: {
        cancel: {
            label: "I'm a cancel button!",
            className: 'btn-danger',
            callback: function(){
                console.log('Custom cancel clicked');
            }
        },
        ok: {
            label: "I'm an OK button!",
            className: 'btn-info',
            callback: function(){
                console.log('Custom OK clicked');
            }
        }
    }
});

$(document).ready(function(e){
    $("#quizModalSuccess").modal("hide");
});


$(document).on('click','.quiz',function() {

   var user = $(this).data("user");
   var category = $(this).data('category');

   $.ajax({
      url : `/quiz/${user}/${category}`,
      method : "GET",
      success : function(){

      },
      error:function() {

      }
   });
});
