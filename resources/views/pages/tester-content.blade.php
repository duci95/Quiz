<a class="btn row justify-content-start btn-info badge text-white mb-2" href="{{route('users.show',['user'=> session()->get('user')->id])}}">Moji rezultati</a>
<div class="row  mb-3 border-top border-bottom p-0 w-75 m-auto">
<div class="row col-3 justify-content-center p-0">
    <span class="badge">Kategorija testa</span>
</div>
<div class="col-6 row justify-content-end align-content-center p-0">
    <span class="badge">Opis testa</span>
</div>
</div>
@foreach($categories as $cat)
<div class="row justify-content-sm-between m-auto p-2 border-top border-bottom mb-3 w-75">
    @if(session()->has('blocked'))
        <div class="row col-3 justify-content-center w-100 p-2">
            <span class="p-2 btn-secondary restrict badge text-white" data-category-name="{{$cat->category_name}}" data-category="{{$cat->id}}" data-user="{{session()->get('user')->id}}" >{{$cat->category_name}}</span>
        </div>
    @else
        <div class="row col-3 w-100">
            <span class="p-2 btn-info quiz badge text-white w-100" data-category-name="{{$cat->category_name}}" data-category="{{$cat->id}}" data-user="{{session()->get('user')->id}}" >{{$cat->category_name}}</span>
        </div>
    @endif
    <div class="col-8">
        <span class="p-2 badge badge-info text-white w-100 text-left pl-5" >{{$cat->description}}</span>
    </div>
</div>
@endforeach
@section('scripts')
    <script src="{{asset("/")}}js/quizRouting.js"></script>
    @if(session()->has('error'))
        <script type="text/javascript">
            bootbox.alert({
                message: "Test je još uvek u pripremi!",
                small: 'small',
                buttons : {
                    ok: {
                        label : 'U redu',
                        className : 'btn-info'
                    }
                }
            });
        </script>
    @endif
    @if(session()->has('blocked'))
        <script type="text/javascript">
            bootbox.alert({
                message: "Nalog blokiran",
                small: 'small',
                buttons : {
                    ok: {
                        label : 'U redu',
                        className : 'btn-info'
                    }
                }
            });
        </script>
    @endif
@endsection
