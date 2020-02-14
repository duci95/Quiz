<div class="d-flex text-center fixed-bottom  bg-dark text-white justify-content-around">
    <span>Dušan Krsmanović Copyright &copy; {{date("Y")}} </span>
    @if(session()->has('user'))
        @if(session()->get('user')->role_id === 1)
            <a href="{{route('admins.index')}}" class="font-italic pr-5 text-left text-info">ICT Expert QUIZ</a>
        @elseif(session()->get('user')->role_id === 2)
            <a href="{{route('categories.index')}}" class="font-italic pr-5 text-left text-info">ICT Expert QUIZ</a>
        @else
        <a href="{{route('index')}}" class="font-italic pr-5 text-left text-info">ICT Expert QUIZ</a>
        @endif
    @else
        <a href="{{route('index')}}" class="font-italic pr-5 text-left text-info">ICT Expert QUIZ</a>
    @endif
    <span id="contact" class="badge btn text-info badge-dark pt-1">Kontakt</span>
    <span class="ml-5 justify-content-between">
        <a href="http://www.facebook.com"><span class="pl-3 text-info"><i class="fa fa-facebook"></i></span></a>
        <a href="http://www.instagram.com"><span class="pl-3 text-info"><i class="fa fa-instagram"></i></span></a>
        <a href="http://www.twitter.com"><span class="pl-3 text-info"><i class="fa fa-twitter"></i></span></a>
        <a href="http://www.youtube.com"><span class="pl-3 text-info"><i class="fa fa-youtube"></i></span></a>
        <a href="http://www.linkedin.com"><span class="pl-3 text-info"><i class="fa fa-linkedin"></i></span></a>
    </span>
    <script src="{{asset("/")}}js/regexPatterns.js"></script>
    <script src="{{asset("/")}}js/functions.js"></script>
    <script>
        $(document).on('click','#contact',function(){
            bootbox.dialog({
                title : "Kontakt",
                message: '<label for="email">Email</label>' +
                    '<input type="email" class="form-control" id="email">' +
                    '<label class="mt-2" for="text">Tekst</label>' +
                    '<textarea class="form-control" id="text"></textarea>',
                buttons:{
                    cancel:{
                        label: 'Odustani',
                        className : "btn-secondary"
                    },
                    ok:{
                        label: "Pošalji",
                        className : 'btn-success',
                        callback : function() {
                            const errors = [];
                            const text = $('#text');
                            const email = $('#email');
                            checkIfFieldsAreEmpty(text,errors);
                            checkForInputErrors(reEmail,email,errors,'Email');
                            if(errors.length !== 0)
                                return false;

                            sendCSRFToken();
                            $.ajax({
                                url:'/contact',
                                method:'POST',
                                data:{
                                    'email' : email.val(),
                                    'text' : text.val()
                                },
                                success:function(data){
                                    $.notify('Uspešno poslato!',{
                                        position : 'bottom right',
                                        className : 'success'
                                    })
                                },
                                error:function(r,s,e){
                                    $.notify('Nije poslato, pokušaj kasnije!',{
                                        position : 'bottom right',
                                        className : 'error'
                                    })
                                }
                            })
                        }
                    }
                }
            })
        });
    </script>
</div>
</body>
</html>
