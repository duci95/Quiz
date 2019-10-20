// $(document).ready(function(){
//    $(document).on('click','.edit',function(){
//        const admin = $(this).data('id');
//        console.log(admin);
//        $.ajax({
//            url:'/admins/' + admin,
//            method:"GET",
//            success:function(response){
//                console.log(response.results.is_blocked);
//                const restrict = response.results.is_blocked;
//                if(restrict)
//                    console.log('banovan');
//                else
//                    console.log('nije banovan');
//                bootbox.dialog({
//                    title:'Izmena korisnika',
//                    message: `

//                 callback: function(){
//
//                 }
//                })
//            },
//            error:function(r,s,e){
//                console.log(s);
//            }
//        })
//     })
// });
